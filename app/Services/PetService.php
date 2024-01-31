<?php

namespace App\Services;

use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class PetService
{
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Pet::create($data);
        });
    }

    public function list(array $data)
    {
        $data['with'] = array_merge([], $data['with'] ?? []);
        return Pet::with($data['with'])->get();
    }
}
