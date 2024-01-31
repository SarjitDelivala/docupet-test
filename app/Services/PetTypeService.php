<?php

namespace App\Services;

use App\Models\PetType;
use Illuminate\Support\Facades\DB;

class PetTypeService
{
    public function list(array $data)
    {
        return DB::transaction(function () use ($data) {
            return PetType::all();
        });
    }
}
