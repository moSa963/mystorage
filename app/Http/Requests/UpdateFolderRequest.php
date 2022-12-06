<?php

namespace App\Http\Requests;

use App\Models\Directory;
use App\Services\DirectoryService;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFolderRequest extends FormRequest
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

    public function update(Directory $directory)
    {
        if ($this->exists("name"))
        {
            try{
                return DirectoryService::rename($directory, $this->validated("name"));
            }catch(Exception) {
                abort(400, "This name already exists.");
            }
        }
    }

    public function rules()
    {
        return [
            'name'=> ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z]+((?![\/<>?|:]).)*$/'],
        ];
    }
}
