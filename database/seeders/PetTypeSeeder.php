<?php

namespace Database\Seeders;

use App\Models\PetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetTypeSeeder extends Seeder
{

    private $types = [
        'Cat' => 0,
        'Dog' => 1,
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->types as $type => $hasDangerous) {
            PetType::updateOrCreate([
                'name' => $type,
                'has_dangerous' => $hasDangerous
            ]);
        }
    }
}
