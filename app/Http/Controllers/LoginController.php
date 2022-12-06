<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(LoginStoreRequest $request){

        $user = $request->login();

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $user->createToken('web')->plainTextToken,
            ],
        ]);
    }

    public function destroy($request){
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
