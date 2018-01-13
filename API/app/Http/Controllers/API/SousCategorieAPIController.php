<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSousCategorieAPIRequest;
use App\Http\Requests\API\UpdateSousCategorieAPIRequest;
use App\Models\SousCategorie;
use App\Repositories\SousCategorieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SousCategorieController
 * @package App\Http\Controllers\API
 */

class SousCategorieAPIController extends AppBaseController
{
    /** @var  SousCategorieRepository */
    private $sousCategorieRepository;

    public function __construct(SousCategorieRepository $sousCategorieRepo)
    {
        $this->sousCategorieRepository = $sousCategorieRepo;
    }

    /**
     * Display a listing of the SousCategorie.
     * GET|HEAD /sousCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sousCategorieRepository->pushCriteria(new RequestCriteria($request));
        $this->sousCategorieRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sousCategories = $this->sousCategorieRepository->paginate(10);

        return $this->sendResponse($sousCategories->toArray(), 'Sous Categories retrieved successfully');
    }

    /**
     * Store a newly created SousCategorie in storage.
     * POST /sousCategories
     *
     * @param CreateSousCategorieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSousCategorieAPIRequest $request)
    {
        $input = $request->all();

        $sousCategories = $this->sousCategorieRepository->create($input);

        return $this->sendResponse($sousCategories->toArray(), 'Sous Categorie saved successfully');
    }

    /**
     * Display the specified SousCategorie.
     * GET|HEAD /sousCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SousCategorie $sousCategorie */
        $sousCategorie = $this->sousCategorieRepository->findWithoutFail($id);

        if (empty($sousCategorie)) {
            return $this->sendError('Sous Categorie not found');
        }

        return $this->sendResponse($sousCategorie->toArray(), 'Sous Categorie retrieved successfully');
    }

    /**
     * Update the specified SousCategorie in storage.
     * PUT/PATCH /sousCategories/{id}
     *
     * @param  int $id
     * @param UpdateSousCategorieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSousCategorieAPIRequest $request)
    {
        $input = $request->all();

        /** @var SousCategorie $sousCategorie */
        $sousCategorie = $this->sousCategorieRepository->findWithoutFail($id);

        if (empty($sousCategorie)) {
            return $this->sendError('Sous Categorie not found');
        }

        $sousCategorie = $this->sousCategorieRepository->update($input, $id);

        return $this->sendResponse($sousCategorie->toArray(), 'SousCategorie updated successfully');
    }

    /**
     * Remove the specified SousCategorie from storage.
     * DELETE /sousCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SousCategorie $sousCategorie */
        $sousCategorie = $this->sousCategorieRepository->findWithoutFail($id);

        if (empty($sousCategorie)) {
            return $this->sendError('Sous Categorie not found');
        }

        $sousCategorie->delete();

        return $this->sendResponse($id, 'Sous Categorie deleted successfully');
    }

    public function categorie($id){
        $sousCategorie = $this->sousCategorieRepository->findWithoutFail($id);
        
        if (empty($sousCategorie)) {
            return $this->sendError('Sous Categorie not found');
        }

        return $this->sendResponse($sousCategorie->categorie,'categorie retrieved successfully');
    }

    public function activites($id){
        $sousCategorie = $this->sousCategorieRepository->findWithoutFail($id);
        
        if (empty($sousCategorie)) {
            return $this->sendError('Sous Categorie not found');
        }

        return $this->sendResponse($sousCategorie->activites,'activites retrieved successfully');
    }
}
