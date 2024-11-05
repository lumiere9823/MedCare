@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>BMI Result</h2>
        <p>Your BMI is: {{ $bmi }}</p>
    </div>
@endsection
