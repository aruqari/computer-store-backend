<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_user" => $this->id_user,
            "id_pelanggan" => $this->id_pelanggan,
            "role" => $this->role,
            "username" => $this->username,
            "token" => $this->token
        ];
    }
}
