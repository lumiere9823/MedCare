<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateInterval;
use DateTime;

class PatientController extends Controller
{
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    public function viewHealthInfo()
    {
        // Logic to view health information
        return view('patient.healthInfo');
    }

    public function showBookingForm()
    {   
        $doctors = User::where('role', 'doctor')->get();
        $start = new DateTime('09:00');
        $end = new DateTime('17:00');
        $interval = new DateInterval('PT30M');
        $slots = [];

        for ($time = clone $start; $time < $end; $time->add($interval)) {
            $endTime = (clone $time)->add($interval);
            $slots[] = $time->format('H:i') . ' - ' . $endTime->format('H:i');
        }
        return view('patient.bookAppointment',compact('doctors', 'slots'));
    }

    public function getAvailableSlots($doctorId)
    {
        $doctor = User::findOrFail($doctorId);

        $timeRange = explode('-', $doctor->time_slot);
        $start = new DateTime($timeRange[0]);
        $end = new DateTime($timeRange[1]);
        $interval = new DateInterval('PT30M');
        $slots = [];

        for ($time = clone $start; $time < $end; $time->add($interval)) {
            $endTime = (clone $time)->add($interval);
            $slots[] = $time->format('H:i') . ' - ' . $endTime->format('H:i');
        }

        return response()->json($slots);
    }

    public function bookAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'time_slot' => 'required|string',
        ]);

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'time_slot' => $request->time_slot,
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Appointment booked successfully!');
    }

    public function showFeedbackForm()
    {
        return view('patient.submitFeedback');
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'patient_id' => Auth::id(),
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Feedback submitted successfully!');
    }

    public function showSchedule()
    {
        $appointments = Appointment::where('patient_id',Auth::id())->with(['doctor', 'patient'])->get();
        return view('appointments.userSchedule', compact('appointments'));
    }

}