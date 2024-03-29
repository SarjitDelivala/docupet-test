<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breed extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'pet_type_id',
        'is_dangerous',
    ];

    public function petType() {
        return $this->belongsTo(PetType::class);
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
