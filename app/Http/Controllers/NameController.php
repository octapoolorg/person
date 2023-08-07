<?php

namespace App\Http\Controllers;

use App\Services\Numerology\NumerologyFactory;
use Illuminate\Http\Request;

class NameController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function view(Request $request)
    {
        $name = $request->input('name');
        $numerology = NumerologyFactory::create('pythagorean');
        $numbers = $numerology->getNumerologyNumbers($name);
        dd($numbers);
    }
}
