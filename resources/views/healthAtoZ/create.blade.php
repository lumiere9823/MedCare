@extends('layouts.app')

@section('content')
    <h1>Add New Disease</h1>

    <form method="POST" action="{{ route('diseases.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Disease</button>
    </form>
@endsection
