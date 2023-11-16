<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Services\Numerology\NumerologyFactory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NumerologyController extends Controller
{
    public function calculator(): View
    {
        return view('tools.numerology.calculator');
    }

    public function calculate(): View
    {
        $name = request('name');
        $dob = request('dob');

        $numerology = NumerologyFactory::create('pythagorean')->getNumerologyData($name, $dob);

        $data = [
            'name' => $name,
            'dob' => $dob,
            'numerology' => $numerology
        ];

        return view('tools.numerology.calculator',compact('data'));
    }
}
