<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function login() : User
    {
        $user = User::where('username', $this->validated("username"))->first();
        
        if (!$user || !Hash::check($this->validated("password"), $user->password)){
            abort(400, 'Username or Password is worng.');
        }

        return $user;
    }


    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z]+([._-]?[A-Za-z0-9]+)*$/'],
            'password' => ['required', 'string', 'min:8', 'max:100'],
            'remember' => ['required', 'boolean'],
        ];
    }
}
