<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategorieProfessionnelleAPIRequest;
use App\Http\Requests\API\UpdateCategorieProfessionnelleAPIRequest;
use App\Models\CategorieProfessionnelle;
use App\Repositories\CategorieProfessionnelleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategorieProfessionnelleController
 * @package App\Http\Controllers\API
 */

class CategorieProfessionnelleAPIController extends AppBaseController
{
    /** @var  CategorieProfessionnelleRepository */
    private $categorieProfessionnelleRepository;

    public function __construct(CategorieProfessionnelleRepository $categorieProfessionnelleRepo)
    {
        $this->categorieProfessionnelleRepository = $categorieProfessionnelleRepo;
    }

    /**
     * Display a listing of the CategorieProfessionnelle.
     * GET|HEAD /categorieProfessionnelles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categorieProfessionnelleRepository->pushCriteria(new RequestCriteria($request));
        $this->categorieProfessionnelleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categorieProfessionnelles = $this->categorieProfessionnelleRepository->paginate(10);

        return $this->sendResponse($categorieProfessionnelles->toArray(), 'Categorie Professionnelles retrieved successfully');
    }

    /**
     * Store a newly created CategorieProfessionnelle in storage.
     * POST /categorieProfessionnelles
     *
     * @param CreateCategorieProfessionnelleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategorieProfessionnelleAPIRequest $request)
    {
        $input = $request->all();

        $categorieProfessionnelles = $this->categorieProfessionnelleRepository->create($input);

        return $this->sendResponse($categorieProfessionnelles->toArray(), 'Categorie Professionnelle saved successfully');
    }

    /**
     * Display the specified CategorieProfessionnelle.
     * GET|HEAD /categorieProfessionnelles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CategorieProfessionnelle $categorieProfessionnelle */
        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->findWithoutFail($id);

        if (empty($categorieProfessionnelle)) {
            return $this->sendError('Categorie Professionnelle not found');
        }

        return $this->sendResponse($categorieProfessionnelle->toArray(), 'Categorie Professionnelle retrieved successfully');
    }

    /**
     * Update the specified CategorieProfessionnelle in storage.
     * PUT/PATCH /categorieProfessionnelles/{id}
     *
     * @param  int $id
     * @param UpdateCategorieProfessionnelleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategorieProfessionnelleAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategorieProfessionnelle $categorieProfessionnelle */
        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->findWithoutFail($id);

        if (empty($categorieProfessionnelle)) {
            return $this->sendError('Categorie Professionnelle not found');
        }

        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->update($input, $id);

        return $this->sendResponse($categorieProfessionnelle->toArray(), 'CategorieProfessionnelle updated successfully');
    }

    /**
     * Remove the specified CategorieProfessionnelle from storage.
     * DELETE /categorieProfessionnelles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CategorieProfessionnelle $categorieProfessionnelle */
        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->findWithoutFail($id);

        if (empty($categorieProfessionnelle)) {
            return $this->sendError('Categorie Professionnelle not found');
        }

        $categorieProfessionnelle->delete();

        return $this->sendResponse($id, 'Categorie Professionnelle deleted successfully');
    }

    public function categorie($id){
        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->findWithoutFail($id);
        
        if (empty($categorieProfessionnelle)) {
            return $this->sendError('Categorie Professionnelle not found');
        }

        return $this->sendResponse($categorieProfessionnelle->categorie,'categorie retrieved successfully');
    }

    public function professionnelle($id){
        $categorieProfessionnelle = $this->categorieProfessionnelleRepository->findWithoutFail($id);
        
        if (empty($categorieProfessionnelle)) {
            return $this->sendError('Categorie Professionnelle not found');
        }

        return $this->sendResponse($categorieProfessionnelle->professionnelle,'professionnelle retrieved successfully');
    }
}
