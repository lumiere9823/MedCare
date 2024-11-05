@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Submit Feedback</h1>
        <form method="POST" action="{{ route('patient.storeFeedback') }}">
            @csrf

            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>
@endsection
