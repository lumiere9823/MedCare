@extends('layouts.app')

@section('content')
    <h1>{{ $disease->name }}</h1>

    <p>{{ $disease->description }}</p>

    <a href="{{ route('diseases.index') }}" class="btn btn-secondary">Back to Diseases</a>
@endsection
