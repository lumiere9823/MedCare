<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        // Logic to process payments
        return redirect()->route('patient.dashboard')->with('success', 'Payment made successfully.');
    }

    public function insuranceReimbursement(Request $request)
    {
        // Logic to process insurance reimbursement
        return redirect()->route('insurance.dashboard')->with('success', 'Reimbursement processed successfully.');
    }
}