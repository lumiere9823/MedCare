@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Manage Users</h2>

        <!-- Filter and Search Form -->
        <form method="GET" action="{{ route('administrator.dashboard') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Filter by Role</option>
                        <option value="administrator" {{ request('role') == 'administrator' ? 'selected' : '' }}>
                            Administrator</option>
                        <option value="patient" {{ request('role') == 'patient' ? 'selected' : '' }}>Patient</option>
                        <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                        <option value="insurance_company" {{ request('role') == 'insurance_company' ? 'selected' : '' }}>
                            Insurance Company</option>
                        <option value="drug_supplier" {{ request('role') == 'drug_supplier' ? 'selected' : '' }}>Drug
                            Supplier</option>
                        <option value="healthcare_provider"
                            {{ request('role') == 'healthcare_provider' ? 'selected' : '' }}>Healthcare Provider</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name or Email"
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('administrator.dashboard') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('admin.editUser', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $users->appends(['role' => request('role'), 'search' => request('search')])->links() }}
        </div>

        <a href="{{ route('admin.createUser') }}" class="btn btn-primary">Add New User</a>
    </div>
@endsection
