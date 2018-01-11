<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActeAPIRequest;
use App\Http\Requests\API\UpdateActeAPIRequest;
use App\Models\Acte;
use App\Repositories\ActeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ActeController
 * @package App\Http\Controllers\API
 */

class ActeAPIController extends AppBaseController
{
    /** @var  ActeRepository */
    private $acteRepository;

    public function __construct(ActeRepository $acteRepo)
    {
        $this->acteRepository = $acteRepo;
    }

    /**
     * Display a listing of the Acte.
     * GET|HEAD /actes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->acteRepository->pushCriteria(new RequestCriteria($request));
        $this->acteRepository->pushCriteria(new LimitOffsetCriteria($request));
        $actes = $this->acteRepository->all();

        return $this->sendResponse($actes->toArray(), 'Actes retrieved successfully');
    }

    /**
     * Store a newly created Acte in storage.
     * POST /actes
     *
     * @param CreateActeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActeAPIRequest $request)
    {
        $input = $request->all();

        $actes = $this->acteRepository->create($input);

        return $this->sendResponse($actes->toArray(), 'Acte saved successfully');
    }

    /**
     * Display the specified Acte.
     * GET|HEAD /actes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Acte $acte */
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        return $this->sendResponse($acte->toArray(), 'Acte retrieved successfully');
    }

    /**
     * Update the specified Acte in storage.
     * PUT/PATCH /actes/{id}
     *
     * @param  int $id
     * @param UpdateActeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Acte $acte */
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        $acte = $this->acteRepository->update($input, $id);

        return $this->sendResponse($acte->toArray(), 'Acte updated successfully');
    }

    /**
     * Remove the specified Acte from storage.
     * DELETE /actes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Acte $acte */
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        $acte->delete();

        return $this->sendResponse($id, 'Acte deleted successfully');
    }

    public function usager($id){
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        return $this->sendResponse($acte->usager,'Usage retrieved successfully');
    }

    public function adaptations($id){
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        return $this->sendResponse($acte->adaptations,'adaptations retrieved successfully');
    }

    public function activite($id){
        $acte = $this->acteRepository->findWithoutFail($id);

        if (empty($acte)) {
            return $this->sendError('Acte not found');
        }

        return $this->sendResponse($acte->activite,'activite retrieved successfully');
    }
}
