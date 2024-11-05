@extends('layouts.app')

@section('content')
    <h1>Disease List</h1>

    <div class="row">
        @foreach ($diseases as $disease)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>{{ $disease->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $disease->description }}</p>
                        <a href="{{ route('diseases.show', $disease->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
