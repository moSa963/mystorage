<?php

namespace App\Http\Requests;

use App\Models\Group;
use App\Models\Directory;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function store(User $user){
        return Group::create([
            'user_id' => $user->id,
            'name' => $this->validated("name"),
            'private' => $this->validated("private") ? true : false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'private' => ['boolean'],
        ];
    }
}
