<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\Numerology\NumerologyFactory;
use App\Services\Tools\FancyTextGenerator;
use Illuminate\Contracts\View\View;

class NameController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function view($name): View
    {
        $nameDetails = Name::with(['gender', 'origin', 'categories'])
            ->where('name', 'like', "%$name%")
            ->firstOrFail();

        $numerology = NumerologyFactory::create('pythagorean');
        $numerology = $numerology->getNumerologyData($nameDetails->name);

        $fancyText = new FancyTextGenerator($nameDetails->name);
        $fancyTexts = $fancyText->generate();

        $data = [
            'nameDetails' => $nameDetails,
            'numerology' => $numerology,
            'fancyTexts' => $fancyTexts
        ];

        return view('names.view', compact('data'));
    }

}
