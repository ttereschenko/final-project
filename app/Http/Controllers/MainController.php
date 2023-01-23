<?php

namespace App\Http\Controllers;

use App\Models\Property;

class MainController extends Controller
{
    public function index()
    {
        $properties = Property::query()->with(['user', 'type'])->latest()->paginate(4);

        return view('main', compact('properties'));
    }
}
