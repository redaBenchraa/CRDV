<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Auth\LoginProxy;

class LoginController extends Controller
{
  //  use AuthenticatesUsers;

    private $loginProxy;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        //return $this->response($this->loginProxy->attemptLogin($username, $password));
        return response()->json($this->loginProxy->attemptLogin($username, $password));
        
    }

    public function refresh(Request $request)
    {
        return $this->response($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return $this->response(null, 204);
    }
}
