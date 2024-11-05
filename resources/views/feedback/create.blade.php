@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Leave Feedback for Appointment</h2>
        <form method="POST" action="{{ route('feedback.store', $appointment->id) }}">
            @csrf
            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="5" required></textarea>
                @error('feedback')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
        </form>
    </div>
@endsection
