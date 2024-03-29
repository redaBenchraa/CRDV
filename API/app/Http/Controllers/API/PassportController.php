<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Professionnelle;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'centre_id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'type' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $prenom = preg_replace('/[[:space:]]+/', '_', $request->prenom);
        $nom = preg_replace('/[[:space:]]+/', '_', $request->nom);
        $input['username'] = $prenom . '.' . $nom;

        $user = Professionnelle::create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}