@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book an Appointment</h1>
        <form method="POST" action="{{ route('patient.storeAppointment') }}">
            @csrf

            <div class="form-group">
                <label for="doctor_id">Select Doctor:</label>
                <select name="doctor_id" id="doctor_id" class="form-control" required>
                    <option value="">-- Select Doctor --</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="time_slot">Time Slot:</label>
                <select name="time_slot" id="time_slot" class="form-control" required>
                    <option value="">-- Select Time Slot --</option>
                    <!-- Time slots will be populated here via AJAX -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Book Appointment</button>
        </form>
    </div>

    <script>
        document.getElementById('doctor_id').addEventListener('change', function() {
            const doctorId = this.value;
            const timeSlotSelect = document.getElementById('time_slot');

            // Clear previous time slots
            timeSlotSelect.innerHTML = '<option value="">-- Select Time Slot --</option>';

            if (doctorId) {
                fetch(`http://127.0.0.1:8000/patient/book-appointment/${doctorId}/slots`)
                    .then(response => response.json())
                    .then(slots => {
                        slots.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = slot;
                            option.textContent = slot;
                            timeSlotSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching time slots:', error));
            }
        });
    </script>
@endsection
