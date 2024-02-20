<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [[
            "id_user" => $this->id_user,
            "id_katalog" => $this->id_katalog,
            "qty" => $this->qty
        ]
        ];
    }
}
