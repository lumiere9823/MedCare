<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCalculatorController extends Controller
{
    public function index()
    {
        return view('healthCalculator.index');
    }

    public function calculateBMI(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $bmi = $request->weight / (($request->height / 100) ** 2);
        return view('healthCalculator.result', compact('bmi'));
    }
}