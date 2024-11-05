@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Health Calculator</h2>
        <form method="POST" action="{{ route('healthCalculator.calculate') }}">
            @csrf
            <div class="form-group">
                <label>Weight (kg)</label>
                <input type="number" name="weight" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Height (cm)</label>
                <input type="number" name="height" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate BMI</button>
        </form>
    </div>
@endsection
