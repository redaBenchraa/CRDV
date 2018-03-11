<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionnelleAPIRequest;
use App\Http\Requests\API\UpdateProfessionnelleAPIRequest;
use App\Models\Professionnelle;
use App\Repositories\ProfessionnelleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $professionnelles = $this->professionnelleRepository->paginate(10);

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
        $prenom = preg_replace('/[[:space:]]+/', '_', $request->prenom);
        $nom = preg_replace('/[[:space:]]+/', '_', $request->nom);
        $input['username'] = $prenom . '.' . $nom.'.'.$request->centre_id;
        $input['password'] = Hash::make($request->password);


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


    public function update($id, Request $request)
    {
        $input = $request->all();
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }
        $professionnelle->nom = $request->input('nom');
        $professionnelle->prenom = $request->input('prenom');
        $professionnelle->type = $request->input('type');
        $professionnelle->username = $request->input('nom').'.'.$request->input('prenom').'.'.$professionnelle->centre_id;
        $professionnelle = $this->professionnelleRepository->update($professionnelle->toArray(), $id);

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

        foreach ($professionnelle->emploiDuTemps as $edt){
            $edt->sousCategorie;
            $edt->groupes;
            $edt->usagers;
            $data[] = $edt;
        }
        return $this->sendResponse($data,'emploiDuTemps retrieved successfully');
    }

    public function validated($id){
        $professionnelle = $this->professionnelleRepository->findWithoutFail($id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        foreach ($professionnelle->emploiDuTemps as $edt){
            $edt->sousCategorie;
            $edt->groupes;
            $edt->usagers;
            $data[] = $edt;
        }
        return $this->sendResponse($data,'emploiDuTemps retrieved successfully');
    }

    public function getMe(){
        return Auth::user();
    }
}
