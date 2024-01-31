<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pet_type_id' => $this->pet_type_id,
            'is_dangerous' => $this->is_dangerous,
            'petType' => new PetTypeResource($this->whenLoaded('petType')),
        ];
    }
}
