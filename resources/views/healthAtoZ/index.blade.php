@extends('layouts.app')

@section('content')
    <h1>Diseases</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('diseases.create') }}" class="btn btn-primary">Add New Disease</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diseases as $disease)
                <tr>
                    <td>{{ $disease->id }}</td>
                    <td>{{ $disease->name }}</td>
                    <td>{{ $disease->description }}</td>
                    <td>
                        <a href="{{ route('diseases.edit', $disease->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('diseases.destroy', $disease->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
