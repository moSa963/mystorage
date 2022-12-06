<?php

namespace App\Http\Requests;

use App\Models\Directory;
use App\Models\DirectoryFile;
use App\Models\File;
use App\Models\User;
use App\Services\DirectoryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class CreateFileRequest extends FormRequest
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

    public function store(User $user, Directory $directory){
        $file = $this->validated("file");

        if (DirectoryService::name_exists($directory, $this->name, $this->extension)){
            abort(400, "file with the same name exists.");
        }

        $path = $file->store($user->username, 'local');

        $new_file = File::create([
            'user_id' => $user->id,
            'name' => $this->validated("name"),
            'storage_path' => $path,
            'extension' => $this->validated("extension"),
            'mime_type' => Storage::mimeType($path),
            'size' => Storage::size($path),
        ]);

        DirectoryFile::create([
            'directory_id' => $directory->id,
            'file_id' => $new_file->id,
        ]);

        return $new_file;
    }


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9]((?![\/<>?|:]).)*$/'],
            'extension' => ['required', 'string', 'regex:/^[a-zA-Z]([a-zA-Z0-9])*$/'],
            'file' => ['file', 'required'],
        ];
    }
}
