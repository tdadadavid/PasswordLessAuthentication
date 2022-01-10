<?php

namespace App;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{

    use ValidatesRequests;


    public Request $request;
    private $rememberMe = false;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function invite()
    {
        // validate the request
        $this->validateRequest()
            ->createToken()
            ->sendTokenToUserEmail();
    }

    public function validateRequest() : AuthenticateUser
    {
        $this->validate($this->request  , [
            'email' => 'required|email|exists:users',
        ]);

        if ($this->request->has('rememberMe'))
            $this->rememberMe = true;

        return  $this;
    }

    public function createToken()
    {
        //get the user
        $user = User::getByEmail($this->request->email);


        //generate token for the user
        return LoginToken::generateTokenFor($user);
    }

    public function login(LoginToken $token)
    {
        // login the user
        Auth::login($token->user , $this->rememberMe);

        // delete the token
        $token->delete();
    }


}
