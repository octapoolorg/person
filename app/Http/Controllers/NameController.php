<?php

namespace App\Http\Controllers;

use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;

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

        $fancyText = new FancyTextGenerator($name);
        $fancyTexts = $fancyText->generate();

        $name = [
            'name' => 'Ali'
        ];

        $data['name'] = [];


        $data['name'] = $name;
        $data['name']['numerology'] = $numerology;
        $data['name']['fancyTexts'] = $fancyTexts;

        return view('names.view', compact('data'));
    }
}
