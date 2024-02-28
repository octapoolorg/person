<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Services\Numerology\NumerologyFactory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NumerologyController extends Controller
{
    public function calculator(Request $request): View
    {
        if ($request->isMethod('post')) {
            return $this->calculate();
        }
        return view('tools.numerology.calculator');
    }

    /**
     * @throws ValidationException
     */
    private function calculate(): View
    {
        $name = ucwords(request('name'));
        $dob = request('dob');

        $this->validate(request(), [
            'name' => 'required|string|min:3|max:255|not_regex:/[0-9]/',
            'dob' => 'required|date',
        ]);

        $numerology = NumerologyFactory::create('pythagorean')->getAnalysis($name, $dob);

        $data = [
            'name' => $name,
            'dob' => $dob,
            'numerology' => $numerology,
        ];

        return view('tools.numerology.calculator', compact('data'));
    }
}
