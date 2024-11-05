@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to WebMed</h1>
        <p>Your one-stop solution for healthcare management.</p>
        @if (Auth::user() == null || Auth::user()->role == 'patient')
            <h2>Patient Options</h2>
            <ul>
                <li><a href="{{ route('patient.viewHealthInfo') }}">View Health Info</a></li>
                <li><a href="{{ route('patient.bookAppointment') }}">Book Appointment</a></li>
            </ul>

            <h2>Heath A-Z</h2>
            <ul>
                <li><a href="{{ route('medications.view') }}">Medication</a></li>
                <li><a href="{{ route('calculate.bmi.form') }}">BMI Calculator</a></li>
                <li><a href="{{ route('diseases.viewUser') }}">View Diseases</a></li>
            </ul>
            @if (Auth::user() !== null && Auth::user()->role == 'patient')
                <h2>Feedback</h2>
                <ul>
                    <li><a href="{{ route('appointments.schedule') }}">Feedback</a></li>
                </ul>
            @endif
        @elseif (Auth::user()->role == 'administrator')
            <h2>Administrator Options</h2>
            <ul>
                <li><a href="{{ route('administrator.dashboard') }}">Administrator Dashboard</a></li>
                <li><a href="{{ route('medications.index') }}">Drug manage</a></li>
                <li><a href="{{ route('diseases.index') }}">Diseases manage</a></li>
            </ul>
        @elseif(Auth::user()->role == 'doctor')
            <h2>Doctor Options</h2>
            <ul>
                <li><a href="{{ route('doctor.dashboard') }}">Doctor Dashboard</a></li>
                <li><a href="{{ route('appointments.schedule') }}">Doctor Feedback</a></li>
            </ul>
        @elseif(Auth::user()->role == 'insurance_company')
            <h2>Insurance Company Options</h2>
            <ul>
                <li><a href="{{ route('insurance_company.dashboard') }}">Insurance Company Dashboard</a></li>
            </ul>
        @elseif(Auth::user()->role == 'drug_supplier')
            <h2>Drug Supplier Options</h2>
            <ul>
                <li><a href="{{ route('drug_supplier.dashboard') }}">Drug Supplier Dashboard</a></li>
            </ul>
        @elseif(Auth::user()->role == 'healthcare_provider')
            <h2>Healthcare Provider Options</h2>
            <ul>
                <li><a href="{{ route('healthcare_provider.dashboard') }}">Healthcare Provider Dashboard</a></li>
            </ul>
        @endif


    </div>
@endsection
