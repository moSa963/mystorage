<?php

namespace App\Http\Requests;

use App\Models\Directory;
use App\Models\Group;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDirectoryRequest extends FormRequest
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

    public function store(Group $group, Directory $parent){
        try{
            return Directory::create([
                'group_id'=> $group->id,
                'name'=> $this->validated("name"),
                'location' => $parent->location.'/'.$parent->name,
            ]);
        } catch(Exception) {
            abort(400, "A folder with the same name exists.");
        }
    }


    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'min:3', 'regex:/^[A-Za-z]+((?![\/<>?|:]).)*$/'],
        ];
    }
}
