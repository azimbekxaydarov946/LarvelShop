<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\LoginStoreRequest;
use App\Http\Requests\Register\PassportStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function register(PassportStoreRequest $passportStoreRequest)
    {
        $params = $passportStoreRequest->validated();
        $params['password'] = bcrypt($params['password']);
        $user = User::create($params);

        $token = $user->createToken('authToken')->accessToken;
        return response()->json(['user' => $token]);
    }

    public function login(LoginStoreRequest $loginStoreRequest)
    {
        $params = $loginStoreRequest->validated();

        if(!auth()->attempt($params)){
            return response()->json('bizda bunday user yoq');
        }


        $token = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => $token]);
    }
}
