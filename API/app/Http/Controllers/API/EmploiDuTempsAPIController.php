<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmploiDuTempsAPIRequest;
use App\Http\Requests\API\UpdateEmploiDuTempsAPIRequest;
use App\Models\EmploiDuTemps;
use App\Repositories\EmploiDuTempsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EmploiDuTempsController
 * @package App\Http\Controllers\API
 */

class EmploiDuTempsAPIController extends AppBaseController
{
    /** @var  EmploiDuTempsRepository */
    private $emploiDuTempsRepository;

    public function __construct(EmploiDuTempsRepository $emploiDuTempsRepo)
    {
        $this->emploiDuTempsRepository = $emploiDuTempsRepo;
    }

    /**
     * Display a listing of the EmploiDuTemps.
     * GET|HEAD /emploiDuTemps
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emploiDuTempsRepository->pushCriteria(new RequestCriteria($request));
        $this->emploiDuTempsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $emploiDuTemps = $this->emploiDuTempsRepository->all();

        return $this->sendResponse($emploiDuTemps->toArray(), 'Emploi Du Temps retrieved successfully');
    }

    /**
     * Store a newly created EmploiDuTemps in storage.
     * POST /emploiDuTemps
     *
     * @param CreateEmploiDuTempsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmploiDuTempsAPIRequest $request)
    {
        $input = $request->all();

        $emploiDuTemps = $this->emploiDuTempsRepository->create($input);

        return $this->sendResponse($emploiDuTemps->toArray(), 'Emploi Du Temps saved successfully');
    }

    /**
     * Display the specified EmploiDuTemps.
     * GET|HEAD /emploiDuTemps/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EmploiDuTemps $emploiDuTemps */
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);

        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        return $this->sendResponse($emploiDuTemps->toArray(), 'Emploi Du Temps retrieved successfully');
    }

    /**
     * Update the specified EmploiDuTemps in storage.
     * PUT/PATCH /emploiDuTemps/{id}
     *
     * @param  int $id
     * @param UpdateEmploiDuTempsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmploiDuTempsAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmploiDuTemps $emploiDuTemps */
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);

        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        $emploiDuTemps = $this->emploiDuTempsRepository->update($input, $id);

        return $this->sendResponse($emploiDuTemps->toArray(), 'EmploiDuTemps updated successfully');
    }

    /**
     * Remove the specified EmploiDuTemps from storage.
     * DELETE /emploiDuTemps/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EmploiDuTemps $emploiDuTemps */
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);

        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        $emploiDuTemps->delete();

        return $this->sendResponse($id, 'Emploi Du Temps deleted successfully');
    }

    public function activite($id){
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);
        
        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        return $this->sendResponse($emploiDuTemps->activite,'activite retrieved successfully');
    }

    public function professionnelle($id){
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);
        
        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        return $this->sendResponse($emploiDuTemps->professionnelle,'professionnelle retrieved successfully');
    }

    public function groupe($id){
        $emploiDuTemps = $this->emploiDuTempsRepository->findWithoutFail($id);
        
        if (empty($emploiDuTemps)) {
            return $this->sendError('Emploi Du Temps not found');
        }

        return $this->sendResponse($emploiDuTemps->groupe,'groupe retrieved successfully');
    }
}
