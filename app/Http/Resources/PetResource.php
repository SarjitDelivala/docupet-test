<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
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
            'breed_id' => $this->breed_id,
            'breed_name' => $this->breed_name,
            'age' => $this->age,
            'dob' => $this->dob,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'petType' => new PetTypeResource($this->whenLoaded('petType')),
            'breed' => new BreedResource($this->whenLoaded('breed')),
        ];
    }
}
