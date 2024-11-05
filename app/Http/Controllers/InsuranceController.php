<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function viewPlans()
    {
        // Logic to view insurance plans
        return view('insurance.plans');
    }

    public function purchaseInsurance(Request $request)
    {
        // Logic to purchase insurance
        return redirect()->route('patient.dashboard')->with('success', 'Insurance purchased successfully.');
    }
}