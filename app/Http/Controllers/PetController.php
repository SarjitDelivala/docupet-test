<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        return view('pets.index');
    }
}
