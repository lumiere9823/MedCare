@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Administrator Dashboard</h1>
        <p>Welcome to the admin dashboard!</p>
        @include('admin.manageUsers', ['users' => $users])
    </div>
@endsection
