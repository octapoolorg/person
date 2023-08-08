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

    public function view($name)
    {
        $numerology = NumerologyFactory::create('pythagorean');
        $numerology = $numerology->getNumerologyNumbers($name);

        $data = [];

        // dd($numerology);

        $data['name'] = $name;
        $data['numerology']['zodiacSign'] = "signnn";


        return view('names.view', compact('data'));
    }
}
