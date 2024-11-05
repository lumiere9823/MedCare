{{-- resources/views/calculateBMI.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Calculate BMI</h1>

        @if (session('result'))
            <div class="alert alert-success">
                {{ session('result') }}
            </div>
        @endif

        <form method="POST" action="{{ route('calculate.bmi') }}">
            @csrf

            <div class="mb-3">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" class="form-control" id="weight" name="weight" step="0.1" required>
                @error('weight')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="height" class="form-label">Height (m)</label>
                <input type="number" class="form-control" id="height" name="height" step="0.01" required>
                @error('height')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Calculate BMI</button>
        </form>
    </div>
@endsection
