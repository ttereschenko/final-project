<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $properties = Property::query()->with(['user', 'type'])->latest()->paginate(4);

        return view('main', compact('properties'));
    }
}
