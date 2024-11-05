@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Medications Management</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            <a href="{{ route('medications.create') }}" class="btn btn-primary">Add Medication</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medications as $medication)
                    <tr>
                        <td>{{ $medication->name }}</td>
                        <td>{{ $medication->description }}</td>
                        <td>{{ $medication->supplier->name }}</td>
                        <td>{{ $medication->price }}</td>
                        <td>{{ $medication->stock_quantity }}</td>
                        <td>
                            <a href="{{ route('medications.edit', $medication->medication_id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('medications.destroy', $medication->medication_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this medication?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
