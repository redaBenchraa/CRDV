<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParametreAPIRequest;
use App\Http\Requests\API\UpdateParametreAPIRequest;
use App\Models\Parametre;
use App\Repositories\ParametreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ParametreController
 * @package App\Http\Controllers\API
 */

class ParametreAPIController extends AppBaseController
{
    /** @var  ParametreRepository */
    private $parametreRepository;

    public function __construct(ParametreRepository $parametreRepo)
    {
        $this->parametreRepository = $parametreRepo;
    }

    /**
     * Display a listing of the Parametre.
     * GET|HEAD /parametres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->parametreRepository->pushCriteria(new RequestCriteria($request));
        $this->parametreRepository->pushCriteria(new LimitOffsetCriteria($request));
        $parametres = $this->parametreRepository->all();

        return $this->sendResponse($parametres->toArray(), 'Parametres retrieved successfully');
    }

    /**
     * Store a newly created Parametre in storage.
     * POST /parametres
     *
     * @param CreateParametreAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateParametreAPIRequest $request)
    {
        $input = $request->all();

        $parametres = $this->parametreRepository->create($input);

        return $this->sendResponse($parametres->toArray(), 'Parametre saved successfully');
    }

    /**
     * Display the specified Parametre.
     * GET|HEAD /parametres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Parametre $parametre */
        $parametre = $this->parametreRepository->findWithoutFail($id);

        if (empty($parametre)) {
            return $this->sendError('Parametre not found');
        }

        return $this->sendResponse($parametre->toArray(), 'Parametre retrieved successfully');
    }

    /**
     * Update the specified Parametre in storage.
     * PUT/PATCH /parametres/{id}
     *
     * @param  int $id
     * @param UpdateParametreAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParametreAPIRequest $request)
    {
        $input = $request->all();

        /** @var Parametre $parametre */
        $parametre = $this->parametreRepository->findWithoutFail($id);

        if (empty($parametre)) {
            return $this->sendError('Parametre not found');
        }

        $parametre = $this->parametreRepository->update($input, $id);

        return $this->sendResponse($parametre->toArray(), 'Parametre updated successfully');
    }

    /**
     * Remove the specified Parametre from storage.
     * DELETE /parametres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Parametre $parametre */
        $parametre = $this->parametreRepository->findWithoutFail($id);

        if (empty($parametre)) {
            return $this->sendError('Parametre not found');
        }

        $parametre->delete();

        return $this->sendResponse($id, 'Parametre deleted successfully');
    }

    public function centre($id){
        $parametre = $this->parametreRepository->findWithoutFail($id);
        
        if (empty($parametre)) {
            return $this->sendError('Parametre not found');
        }

        return $this->sendResponse($parametre->centre,'centres retrieved successfully');
    }


    public function parametreValue($id,$nom){

        $param['centre_id'] = $id;
        $param['nom'] = $nom;
        $parametre = $this->parametreRepository->findWhere($param);

        if (empty($parametre)) {
            return $this->sendError('Centre not found');
        }

        return $this->sendResponse($parametre[0]->valeur,'Parametre value retrieved successfully');
    }
}
