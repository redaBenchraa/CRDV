<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActiviteAPIRequest;
use App\Http\Requests\API\UpdateActiviteAPIRequest;
use App\Models\Activite;
use App\Repositories\ActiviteRepository;
use App\Repositories\ActeRepository;
use App\Repositories\ParametreRepository;
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
    /** @var  ActeRepository */
    private $acteRepository;
     /** @var  ParametreRepository */
     private $parametreRepository;

    

    public function __construct(ActiviteRepository $activiteRepo,ActeRepository $acteRepo,ParametreRepository $parametreRepo)
    {
        $this->activiteRepository = $activiteRepo;
        $this->acteRepository = $acteRepo;
        $this->parametreRepository = $parametreRepo;
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
        $activites = $this->activiteRepository->paginate(10);

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
        $input['cloture'] = false;

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

    public function acte($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->acte,'acte retrieved successfully');
    }

    public function emploiDuTemps($id){
        $activite = $this->activiteRepository->findWithoutFail($id);

        if (empty($activite)) {
            return $this->sendError('Activite not found');
        }

        return $this->sendResponse($activite->emploiDuTemps,'emploiDuTemps retrieved successfully');
    }

    public function valider($id,$bool){

        $param['professionnelle_id'] = $id;
        $param['planifie'] = $bool;
        $param['cloture'] = 0;
        $activite = $this->activiteRepository->findWhere($param);

    
        foreach($activite as $act){

            if( $act->sousCategorie->type == 1 ){//direct

                $centreParamDirect['centre_id'] =  $act->professionnelle->centre_id;
                $centreParamDirect['nom'] = 1;
                $parametre = $this->parametreRepository->findWhere($centreParamDirect);

                if(!$parametre->isEmpty()){
                    $acteParam['duree'] = $parametre[0]->valeur;
                }else{
                    $acteParam['duree'] = 45;
                }

                $acteParam['modeSaisie'] = 'individual';
                $acteParam['usager_id'] = $act->usager_id;
                $acteParam['complet'] = 1;
                $acteParam['cumuleDuree'] = $act->duree;
                $acte = $this->acteRepository->create($acteParam);
                
                $activiteParam['acte_id'] = $acte->id;
                $activiteParam['cloture'] = 1;
                $updatedActivite = $this->activiteRepository->update( $activiteParam, $act->id);
              
            }
            else{//Indirect

                $actesParam['complet'] = 0;
                $actesParam['usager_id'] = $act->usager_id;
                $acte = $this->acteRepository->findWhere($actesParam);

                if(!$acte->isEmpty()){

                    $activiteParam['acte_id'] = $acte[0]->id;
                    $activiteParam['cloture'] = 1;
                    $updatedActivite = $this->activiteRepository->update( $activiteParam, $act->id);
    
                    $acteParam['cumuleDuree'] = $acte[0]->cumuleDuree + $act->duree;
                    $acte = $this->acteRepository->update($acteParam, $acte[0]->id);
    
                    if($acte->duree == $acte->cumuleDuree){
    
                        $acteParam['complet'] = 1;
                        $acte = $this->acteRepository->update($acteParam, $acte->id);
                    }
                }
                else{

                    $centreParamIndirect['centre_id'] =  $act->professionnelle->centre_id;
                    $centreParamIndirect['nom'] = 3;
                    $parametre = $this->parametreRepository->findWhere($centreParamIndirect);

                    if(!$parametre->isEmpty()){
                        $acteParam['duree'] = $parametre[0]->valeur;
                    }else{
                        $acteParam['duree'] = 30;
                    }

                    $acteParam['modeSaisie'] = 'individual';
                    $acteParam['usager_id'] = $act->usager_id;
                    $acteParam['complet'] = 0;
                    $acteParam['cumuleDuree'] = $act->duree;
                    $acte = $this->acteRepository->create($acteParam);

                    $activiteParam['acte_id'] = $acte->id;
                    $activiteParam['cloture'] = 1;
                    $updatedActivite = $this->activiteRepository->update( $activiteParam, $act->id);

                }

            }
        
    }

    return $this->sendResponse($activite->toArray(), 'Activite updated successfully');
    
    //Activite::query()->where('planifie',$bool)->update(['cloture' => true]);
}

    public function planned($bool){
        
        $activite = $this->activiteRepository->findByField('planifie',$bool);
        
        return $this->sendResponse($activite->toArray(), 'Activite updated successfully');
        
    }


}
