@extends('layouts.app')

@section('content')
    <h1>Edit Disease</h1>

    <form method="POST" action="{{ route('diseases.update', $disease->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $disease->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $disease->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Disease</button>
    </form>
@endsection
