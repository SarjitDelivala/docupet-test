<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\PetType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    private $catBreeds = [
        'Persian' => 0,
        'Siamese' => 0,
        'Maine' => 0,
        'Bengal' => 0,
        'Sphynx' => 0,
    ];

    private $dogBreeds = [
        'Labrador Retriever' => 0,
        'German Shepherd' => 0,
        'Golden Retriever' => 0,
        'French Bulldog' => 0,
        'Poodle' => 0,
        'Pitbull' => 1,
        'Mastiff' => 1,
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat = PetType::where('name', 'Cat')->firstOrFail();

        foreach ($this->catBreeds as $catBreed => $isDangerous) {
            Breed::create([
                'name' => $catBreed,
                'is_dangerous' => $isDangerous,
                'pet_type_id' => $cat->id,
            ]);
        }

        $dog = PetType::where('name', 'Dog')->firstOrFail();

        foreach ($this->dogBreeds as $dogBreed => $isDangerous) {
            Breed::create([
                'name' => $dogBreed,
                'is_dangerous' => $isDangerous,
                'pet_type_id' => $dog->id,
            ]);
        }
    }
}
