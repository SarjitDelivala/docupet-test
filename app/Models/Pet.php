<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'pet_type_id',
        'breed_id',
        'breed',
        'age',
        'dob',
    ];

    public function petType()
    {
        return $this->belongsTo(PetType::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }
}
