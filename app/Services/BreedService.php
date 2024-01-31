<?php

namespace App\Services;

use App\Models\Breed;
use Illuminate\Support\Facades\DB;

class BreedService
{
    public function list(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Breed::all();
        });
    }
}
