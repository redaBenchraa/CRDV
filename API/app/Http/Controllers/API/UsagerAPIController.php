<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUsagerAPIRequest;
use App\Http\Requests\API\UpdateUsagerAPIRequest;
use App\Models\Usager;
use App\Repositories\UsagerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UsagerController
 * @package App\Http\Controllers\API
 */

class UsagerAPIController extends AppBaseController
{
    /** @var  UsagerRepository */
    private $usagerRepository;

    public function __construct(UsagerRepository $usagerRepo)
    {
        $this->usagerRepository = $usagerRepo;
    }

    /**
     * Display a listing of the Usager.
     * GET|HEAD /usagers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->usagerRepository->pushCriteria(new RequestCriteria($request));
        $this->usagerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $usagers = $this->usagerRepository->paginate(10);

        return $this->sendResponse($usagers->toArray(), 'Usagers retrieved successfully');
    }

    /**
     * Store a newly created Usager in storage.
     * POST /usagers
     *
     * @param CreateUsagerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUsagerAPIRequest $request)
    {
        $input = $request->all();

        $usagers = $this->usagerRepository->create($input);

        return $this->sendResponse($usagers->toArray(), 'Usager saved successfully');
    }

    /**
     * Display the specified Usager.
     * GET|HEAD /usagers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Usager $usager */
        $usager = $this->usagerRepository->findWithoutFail($id);

        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        return $this->sendResponse($usager->toArray(), 'Usager retrieved successfully');
    }

    /**
     * Update the specified Usager in storage.
     * PUT/PATCH /usagers/{id}
     *
     * @param  int $id
     * @param UpdateUsagerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsagerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Usager $usager */
        $usager = $this->usagerRepository->findWithoutFail($id);

        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        $usager = $this->usagerRepository->update($input, $id);

        return $this->sendResponse($usager->toArray(), 'Usager updated successfully');
    }

    /**
     * Remove the specified Usager from storage.
     * DELETE /usagers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Usager $usager */
        $usager = $this->usagerRepository->findWithoutFail($id);

        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        $usager->delete();

        return $this->sendResponse($id, 'Usager deleted successfully');
    }

    public function centre($id){
        $usager = $this->usagerRepository->findWithoutFail($id);
        
        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        return $this->sendResponse($usager->centre,'centre retrieved successfully');
    }

    public function actes($id){
        $usager = $this->usagerRepository->findWithoutFail($id);
        
        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        return $this->sendResponse($usager->actes,'actes retrieved successfully');
    }

    public function activites($id){
        $usager = $this->usagerRepository->findWithoutFail($id);
        
        if (empty($usager)) {
            return $this->sendError('Usager not found');
        }

        return $this->sendResponse($usager->activites,'activites retrieved successfully');
    }
}
