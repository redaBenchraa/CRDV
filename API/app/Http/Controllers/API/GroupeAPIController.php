<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGroupeAPIRequest;
use App\Http\Requests\API\UpdateGroupeAPIRequest;
use App\Models\Groupe;
use App\Repositories\GroupeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class GroupeController
 * @package App\Http\Controllers\API
 */

class GroupeAPIController extends AppBaseController
{
    /** @var  GroupeRepository */
    private $groupeRepository;

    public function __construct(GroupeRepository $groupeRepo)
    {
        $this->groupeRepository = $groupeRepo;
    }

    /**
     * Display a listing of the Groupe.
     * GET|HEAD /groupes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->groupeRepository->pushCriteria(new RequestCriteria($request));
        $this->groupeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $groupes = $this->groupeRepository->all();

        return $this->sendResponse($groupes->toArray(), 'Groupes retrieved successfully');
    }

    /**
     * Store a newly created Groupe in storage.
     * POST /groupes
     *
     * @param CreateGroupeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupeAPIRequest $request)
    {
        $input = $request->all();

        $groupes = $this->groupeRepository->create($input);

        return $this->sendResponse($groupes->toArray(), 'Groupe saved successfully');
    }

    /**
     * Display the specified Groupe.
     * GET|HEAD /groupes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Groupe $groupe */
        $groupe = $this->groupeRepository->findWithoutFail($id);

        if (empty($groupe)) {
            return $this->sendError('Groupe not found');
        }

        return $this->sendResponse($groupe->toArray(), 'Groupe retrieved successfully');
    }

    /**
     * Update the specified Groupe in storage.
     * PUT/PATCH /groupes/{id}
     *
     * @param  int $id
     * @param UpdateGroupeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Groupe $groupe */
        $groupe = $this->groupeRepository->findWithoutFail($id);

        if (empty($groupe)) {
            return $this->sendError('Groupe not found');
        }

        $groupe = $this->groupeRepository->update($input, $id);

        return $this->sendResponse($groupe->toArray(), 'Groupe updated successfully');
    }

    /**
     * Remove the specified Groupe from storage.
     * DELETE /groupes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Groupe $groupe */
        $groupe = $this->groupeRepository->findWithoutFail($id);

        if (empty($groupe)) {
            return $this->sendError('Groupe not found');
        }

        $groupe->delete();

        return $this->sendResponse($id, 'Groupe deleted successfully');
    }

    public function emploidutemps($id){
        $groupe = $this->groupeRepository->findWithoutFail($id);
        
        if (empty($groupe)) {
            return $this->sendError('Groupe not found');
        }

        return $this->sendResponse($groupe->emploidutemps,'emploidutemps retrieved successfully');
    }

    public function usagers($id){
        $groupe = $this->groupeRepository->findWithoutFail($id);
        
        if (empty($groupe)) {
            return $this->sendError('Groupe not found');
        }

        return $this->sendResponse($groupe->usagers,'usagers retrieved successfully');
    }
}
