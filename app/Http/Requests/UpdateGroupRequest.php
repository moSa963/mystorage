<?php

namespace App\Http\Requests;

use App\Models\Group;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateGroupRequest extends FormRequest
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

    private function updateName(Group $group) 
    {
        try{
            $group->update([ "name" => $this->validated("name") ]);
        }catch(Exception){
            abort(400, 'group with the same name already exist');
        }
    }

    private function updatePrivate(Group $group) 
    {
        if ($group->is_master){
            abort(403, 'you can not make the master group puplic.');
        }
        
        $group->update([
            "private" => $this->validated("private"),
        ]);
    }

    private function updateImage(Group $group)
    {
        $file = $this->validated("image");
        Storage::delete("groups/{$group->id}");
        Storage::putFileAs("groups", $file, $group->id);
    }

    public function update(Group $group)
    {
        if ($this->exists("name"))
        {
            $this->updateName($group);
        }
        if ($this->exists("private"))
        {
            $this->updatePrivate($group);
        }
        if ($this->exists("image"))
        {
            $this->updateImage($group);
        }
    }

    public function rules()
    {
        return [
            'name'=> ['string', 'max:255', 'min:3', 'regex:/^[a-zA-Z]+((?![\/<>?|:]).)*$/'],
            'private'=> [ 'boolean'],
            'image' => ['image'],
        ];
    }
}
