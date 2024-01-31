<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BreedResource;
use App\Services\BreedService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BreedController extends Controller
{

    private $service;

    public function __construct(BreedService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $data = $request->all();

        return BreedResource::collection($this->service->list($data));
    }

}
