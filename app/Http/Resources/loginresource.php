<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class loginresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'work' => 'done',
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'token' => $this->createToken('API Token')->plainTextToken,
        ];
    }
}
