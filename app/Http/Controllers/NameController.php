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
        // Existing logic for numerology and fancy texts
        $numerology = NumerologyFactory::create('pythagorean');
        $numerology = $numerology->getNumerologyData($name);

        $fancyText = new FancyTextGenerator($name);
        $fancyTexts = $fancyText->generate();

        $nameDetails = Name::with(['gender', 'origin', 'categories'])
            ->where('name', $name)
            ->first();

        // Check if the name exists
        if (!$nameDetails) {
            // Handle the case where the name is not found, e.g., show a 404 page
            abort(404, 'Name not found');
        }

        // Prepare the data for the view
        $data['name'] = [
            'name' => $name,
            'details' => $nameDetails,  // The fetched details from the database
            'numerology' => $numerology,
            'fancyTexts' => $fancyTexts
        ];

        dd($data);

        return view('names.view', compact('data'));
    }

}
