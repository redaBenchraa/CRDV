<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCentreAPIRequest;
use App\Http\Requests\API\UpdateCentreAPIRequest;
use App\Models\Centre;
use App\Repositories\CentreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CentreController
 * @package App\Http\Controllers\API
 */

class CentreAPIController extends AppBaseController
{
    /** @var  CentreRepository */
    private $centreRepository;

    public function __construct(CentreRepository $centreRepo)
    {
        $this->centreRepository = $centreRepo;
    }

    /**
     * Display a listing of the Centre.
     * GET|HEAD /centres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->centreRepository->pushCriteria(new RequestCriteria($request));
        $this->centreRepository->pushCriteria(new LimitOffsetCriteria($request));
        $centres = $this->centreRepository->paginate(10);

        return $this->sendResponse($centres->toArray(), 'Centres retrieved successfully');
    }

    /**
     * Store a newly created Centre in storage.
     * POST /centres
     *
     * @param CreateCentreAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCentreAPIRequest $request)
    {
        $input = $request->all();

        $centres = $this->centreRepository->create($input);

        return $this->sendResponse($centres->toArray(), 'Centre saved successfully');
    }

    /**
     * Display the specified Centre.
     * GET|HEAD /centres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Centre $centre */
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($centre->toArray(), 'Centre retrieved successfully');
    }

    /**
     * Update the specified Centre in storage.
     * PUT/PATCH /centres/{id}
     *
     * @param  int $id
     * @param UpdateCentreAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCentreAPIRequest $request)
    {
        $input = $request->all();

        /** @var Centre $centre */
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        $centre = $this->centreRepository->update($input, $id);

        return $this->sendResponse($centre->toArray(), 'Centre updated successfully');
    }

    /**
     * Remove the specified Centre from storage.
     * DELETE /centres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Centre $centre */
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        $centre->delete();

        return $this->sendResponse($id, 'Centre deleted successfully');
    }

    public function professionnelle($id){
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }
        //dump($centre->professionnelles);

        return $this->sendResponse($centre->professionnelles,'bo3');
    }

    public function categories($id){
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($centre->categories,'bo3');
    }

    public function usagers($id){
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($centre->usagers,'bo3');
    }

    public function groupes($id){
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($centre->groupes,'bo3');
    }

    public function parametres($id){
        $centre = $this->centreRepository->findWithoutFail($id);

        if (empty($centre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($centre->parametres,'bo3');
    }
}
