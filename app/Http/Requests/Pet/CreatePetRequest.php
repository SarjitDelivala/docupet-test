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
        $rules = [
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
                'required_without:dob',
            ],
            'dob' => [
                'nullable',
                'date',
                'required_without:age',
            ],
            'gender' => [
                'string',
                'required',
            ]
        ];

        if (in_array($this->input('breed_id'), $this->getOtherBreeds()) && $this->input('breed_known') == "It's a mix") {
            $rules['breed_name'] = [
                'string',
                'required',
            ];
        }

        return $rules;
    }

    function getOtherBreeds()
    {
        return Breed::where('name', "Can't find it?")->pluck('id')->toArray();
    }
}
