<?php

namespace App\Http\Controllers;

use App\AuthenticateUser;
use App\Models\LoginToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends  Controller
{

    private AuthenticateUser $auth;

    public function __construct(AuthenticateUser $auth)
    {
        $this->auth = $auth;
    }

    public function login(): View
    {
        return view('mylogin');
    }

    public function postLogin()
    {
        $this->auth->invite();


        return "Sweet - go check your email";
    }

    public function authenticate(LoginToken $token)
    {
        $this->auth->login($token);

        return redirect('/dashboard');

    }

    public function logout()
    {
        Auth::logout();

        return redirect('/mylogin');

    }

}
