<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActiviteAPIRequest;
use App\Http\Requests\API\UpdateActiviteAPIRequest;
use App\Models\Activite;
use App\Repositories\ActiviteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ActiviteController
 * @package App\Http\Controllers\API
 */

class ActiviteAPIController extends AppBaseController
{
    /** @var  ActiviteRepository */
    private $activiteRepository;

    public function __construct(ActiviteRepository $activiteRepo)
    {
        $this->activiteRepository = $activiteRepo;
    }

    /**
     * Display a listing of the Activite.
     * GET|HEAD /activites
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->activiteRepository->pushCriteria(new RequestCriteria($request));
        $this->activiteRepository->pushCriteria(new LimitOffsetCriteria($request));
        $activites = $this->activiteRepository->all();

        return $this->sendResponse($activites->toArray(), 'Activites retrieved successfully');
    }

    /**
     * Store a newly created Activite in storage.
     * POST /activites
     *
     * @param CreateActiviteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActiviteAPIRequest $request)
    {
        $input = $request->all();

        $activites = $this->activiteRepository->create($input);

        return $this->sendResponse($activites->toArray(), 'Activite saved successfully');
    }

    /**
     * Display the specified Activite.
     * GET|HEAD /activites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Activite $activite */
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->toArray(), 'Activite retrieved successfully');
    }

    /**
     * Update the specified Activite in storage.
     * PUT/PATCH /activites/{id}
     *
     * @param  int $id
     * @param UpdateActiviteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActiviteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Activite $activite */
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        $activite = $this->activiteRepository->update($input, $id);

        return $this->sendResponse($activite->toArray(), 'Activite updated successfully');
    }

    /**
     * Remove the specified Activite from storage.
     * DELETE /activites/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Activite $activite */
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        $activite->delete();

        return $this->sendResponse($id, 'Activite deleted successfully');
    }

    public function sousCategorie($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->sousCategorie,'sousCategorie retrieved successfully');
    }

    public function usager($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->usager,'usager retrieved successfully');
    }

    public function professionnelle($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->professionnelle,'professionnelle retrieved successfully');
    }

    public function actes($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->actes,'actes retrieved successfully');
    }

    public function emploiDuTemps($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->emploiDuTemps,'emploiDuTemps retrieved successfully');
    }
}
