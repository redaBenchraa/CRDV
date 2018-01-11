<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionnelleAPIRequest;
use App\Http\Requests\API\UpdateProfessionnelleAPIRequest;
use App\Models\Professionnelle;
use App\Repositories\ProfessionnelleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProfessionnelleController
 * @package App\Http\Controllers\API
 */

class ProfessionnelleAPIController extends AppBaseController
{
    /** @var  ProfessionnelleRepository */
    private $professionnelleRepository;

    public function __construct(ProfessionnelleRepository $professionnelleRepo)
    {
        $this->professionnelleRepository = $professionnelleRepo;
    }

    /**
     * Display a listing of the Professionnelle.
     * GET|HEAD /professionnelles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->professionnelleRepository->pushCriteria(new RequestCriteria($request));
        $this->professionnelleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $professionnelles = $this->professionnelleRepository->all();

        return $this->sendResponse($professionnelles->toArray(), 'Professionnelles retrieved successfully');
    }

    /**
     * Store a newly created Professionnelle in storage.
     * POST /professionnelles
     *
     * @param CreateProfessionnelleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfessionnelleAPIRequest $request)
    {
        $input = $request->all();

        $professionnelles = $this->professionnelleRepository->create($input);

        return $this->sendResponse($professionnelles->toArray(), 'Professionnelle saved successfully');
    }

    /**
     * Display the specified Professionnelle.
     * GET|HEAD /professionnelles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Professionnelle $professionnelle */
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        return $this->sendResponse($professionnelle->toArray(), 'Professionnelle retrieved successfully');
    }

    /**
     * Update the specified Professionnelle in storage.
     * PUT/PATCH /professionnelles/{id}
     *
     * @param  int $id
     * @param UpdateProfessionnelleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfessionnelleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Professionnelle $professionnelle */
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        $professionnelle = $this->professionnelleRepository->update($input, $id);

        return $this->sendResponse($professionnelle->toArray(), 'Professionnelle updated successfully');
    }

    /**
     * Remove the specified Professionnelle from storage.
     * DELETE /professionnelles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Professionnelle $professionnelle */
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        $professionnelle->delete();

        return $this->sendResponse($id, 'Professionnelle deleted successfully');
    }

    public function centre($id){
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);
        
        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        return $this->sendResponse($professionnelle->centre,'centre retrieved successfully');
    }

    public function activites($id){
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);
        
        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        return $this->sendResponse($professionnelle->activites,'activites retrieved successfully');
    }

    public function categories($id){
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);
        
        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        return $this->sendResponse($professionnelle->categories,'categories retrieved successfully');
    }

    public function emploiDuTemps($id){
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);
        
        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        return $this->sendResponse($professionnelle->emploiDuTemps,'emploiDuTemps retrieved successfully');
    }
}
