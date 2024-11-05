@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to WebMed</h1>
        <p>Your one-stop solution for healthcare management.</p>

        <h2>Patient Options</h2>
        <ul>
            <li><a href="{{ route('patient.viewHealthInfo') }}">View Health Info</a></li>
            <li><a href="{{ route('patient.bookAppointment') }}">Book Appointment</a></li>
        </ul>

        <h2>Guest Options</h2>
        <ul>
            <li><a href="{{ route('guest.index') }}">Guest Dashboard</a></li>
        </ul>

        <h2>Feed back</h2>
        <ul>
            <li><a href="{{ route('guest.index') }}">Guest Dashboard</a></li>
        </ul>
    </div>
@endsection
