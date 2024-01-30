<?php

namespace Database\Seeders;

use App\Models\PetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetTypeSeeder extends Seeder
{

    private $types = [
        'Cat',
        'Dog',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->types as $type) {
            PetType::updateOrCreate([
                'name' => $type,
            ]);
        }
    }
}
