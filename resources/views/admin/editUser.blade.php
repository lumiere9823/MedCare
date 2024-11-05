{{-- resources/views/admin/editUser.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.updateUser', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                    required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required onchange="toggleTimeSlot()">
                    <option value="">Select a role</option>
                    <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>
                        Administrator</option>
                    <option value="patient" {{ old('role', $user->role) == 'patient' ? 'selected' : '' }}>Patient</option>
                    <option value="doctor" {{ old('role', $user->role) == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="guest" {{ old('role', $user->role) == 'guest' ? 'selected' : '' }}>Guest</option>
                    <option value="insurance_company"
                        {{ old('role', $user->role) == 'insurance_company' ? 'selected' : '' }}>Insurance Company</option>
                    <option value="drug_supplier" {{ old('role', $user->role) == 'drug_supplier' ? 'selected' : '' }}>Drug
                        Supplier</option>
                    <option value="healthcare_provider"
                        {{ old('role', $user->role) == 'healthcare_provider' ? 'selected' : '' }}>Healthcare Provider
                    </option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="timeSlotContainer"
                style="{{ old('role', $user->role) == 'doctor' ? '' : 'display:none;' }}">
                <label for="time_slot" class="form-label">Working Time Slot</label>
                <select class="form-select" id="time_slot" name="time_slot" required>
                    <option value="">Select a time slot</option>
                    <option value="09:00-12:00"
                        {{ old('time_slot', $user->time_slot) == '09:00-12:00' ? 'selected' : '' }}>09:00-12:00</option>
                    <option value="13:00-17:00"
                        {{ old('time_slot', $user->time_slot) == '13:00-17:00' ? 'selected' : '' }}>13:00-17:00</option>
                    <option value="09:00-17:00"
                        {{ old('time_slot', $user->time_slot) == '09:00-17:00' ? 'selected' : '' }}>09:00-17:00</option>
                    <option value="11:00-14:00"
                        {{ old('time_slot', $user->time_slot) == '11:00-14:00' ? 'selected' : '' }}>11:00-14:00</option>
                    <option value="15:00-18:00"
                        {{ old('time_slot', $user->time_slot) == '15:00-18:00' ? 'selected' : '' }}>15:00-18:00</option>
                    <option value="Other" {{ old('time_slot', $user->time_slot) == 'Other' ? 'selected' : '' }}>Other
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>

    <script>
        function toggleTimeSlot() {
            var roleSelect = document.getElementById('role');
            var timeSlotContainer = document.getElementById('timeSlotContainer');
            var timeSlotSelect = document.getElementById('time_slot');

            if (roleSelect.value === 'doctor') {
                timeSlotContainer.style.display = 'block';
                timeSlotSelect.setAttribute('required', 'required'); // Set required
            } else {
                timeSlotContainer.style.display = 'none';
                timeSlotSelect.removeAttribute('required'); // Remove required
            }
        }

        // Call the function on page load to set the initial state
        window.onload = toggleTimeSlot;
    </script>
@endsection
