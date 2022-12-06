<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "name" => $this->name,
            "size" => $this->size,
            "mime_type" => $this->mime_type,
            "extension" => $this->extension,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => [
                    "user_id" => $this->user_id,
                    "username" => $this->user->username,
                ],
        ];
    }
}
