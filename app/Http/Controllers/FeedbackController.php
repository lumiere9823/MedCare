<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Show feedback form for a specific appointment
    public function create(Appointment $appointment)
    {
        return view('feedback.create', compact('appointment'));
    }

    // Store the feedback
    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'patient_id' => auth()->id(), // Assuming the user is authenticated and is a patient
            'appointment_id' => $appointment->id,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('appointments.schedule')->with('success', 'Thank you for your feedback!');
    }
}