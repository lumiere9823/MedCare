@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Patient Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>

        <div class="card">
            <div class="card-header">
                Quick Links
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('patient.viewHealthInfo') }}">View Health Information</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('patient.bookAppointment') }}">Book an Appointment</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">View Medical History</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Manage Prescriptions</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Contact Support</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
