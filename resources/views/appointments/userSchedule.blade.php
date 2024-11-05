@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Appointment Schedule</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Patient</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                        <td>{{ $appointment->time_slot }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <a href="{{ route('feedback.create', $appointment->id) }}" class="btn btn-info">Leave
                                Feedback</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
