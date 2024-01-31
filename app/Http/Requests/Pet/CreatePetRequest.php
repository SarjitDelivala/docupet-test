<?php

namespace App\Http\Requests\Pet;

use App\Models\Breed;
use App\Models\PetType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'pet_type_id' => [
                'required',
                Rule::exists(PetType::class, 'id')->whereNull('deleted_at'),
            ],
            'breed_id' => [
                'required',
                Rule::exists(Breed::class, 'id')->whereNull('deleted_at'),
            ],
            'breed_name' => [
                'nullable',
                'string',
            ],
            'age' => [
                'nullable',
                'integer',
            ],
            'dob' => [
                'nullable',
                'date',
            ],
            'gender' => [
                'string',
                'required',
            ]
        ];
    }
}
