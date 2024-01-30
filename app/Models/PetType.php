<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetType extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'has_dangerous',
    ];

    public function breeds() {
        return $this->hasMany(Breed::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

}
