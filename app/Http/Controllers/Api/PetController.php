<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pet\CreatePetRequest;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    private $service;

    public function __construct(PetService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PetResource::collection($this->service->list($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePetRequest $request)
    {
        $data = $request->validated();
        return new PetResource($this->service->store($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pet $pet)
    {
        return new PetResource($pet);
    }

}
