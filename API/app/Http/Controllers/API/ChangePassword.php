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
 * Class ChangePassword
 * @package App\Http\Controllers\Auth
 */

class ChangePassword extends AppBaseController
{
    /** @var  ProfessionnelleRepository */
    private $professionnelleRepository;
    
    public function __construct(ProfessionnelleRepository $professionnelleRepo)
    {
        $this->professionnelleRepository = $professionnelleRepo;
    }

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function reset(Request $request)
    {
        $professionnelle = $this->professionnelleRepository->findWithoutFail($request->id);

        if (empty($professionnelle)) {
            return $this->sendError('Professionnelle not found');
        }

        $input = $professionnelle;

        $oldPassword = $request->old_password;
        $password = $request->password;
        $confirmedPassword = $request->confirmed_password;

        if($oldPassword == $professionnelle->password && $password == $confirmedPassword ){
            $input['password'] = $password;
            $professionnelle = $this->professionnelleRepository->update($input->toArray(), $request->id);
            return $this->sendResponse($professionnelle->toArray(), 'Professionnelle updated successfully');
        }
        else return $this->sendResponse('Error', ' Invalid old or confirmed password');
    }


}
