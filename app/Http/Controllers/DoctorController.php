<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        return view('doctor.dashboard');
    }

    public function showDoctorSchedule()
    {
        $appointments = Appointment::with('doctor', 'patient', 'feedback') 
            ->where('doctor_id', Auth::id()) 
            ->whereDate('appointment_date', '=', now()->toDateString())
            ->get();

        return view('appointments.doctorSchedule', compact('appointments'));
    }
    
    public function showDoctorScheduleMonthly()
    {
        $appointments = Appointment::with('doctor', 'patient', 'feedback') 
            ->where('doctor_id', Auth::id()) 
            ->whereMonth('appointment_date', now()->month) 
            ->whereYear('appointment_date', now()->year)  
            ->get();

        return view('appointments.doctorSchedule', compact('appointments'));
    }

    public function showDoctorScheduleYear()
    {
        $appointments = Appointment::with('doctor', 'patient', 'feedback') 
            ->where('doctor_id', Auth::id()) 
            ->get();

        return view('appointments.doctorSchedule', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $appointment->status = $validated['status'];
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

}