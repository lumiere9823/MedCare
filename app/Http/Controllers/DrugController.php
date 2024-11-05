<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index()
    {
        // Logic to view available medications
        return view('drugs.index');
    }

    public function order(Request $request)
    {
        // Logic to order medication
        return redirect()->route('patient.dashboard')->with('success', 'Medication ordered successfully.');
    }
}