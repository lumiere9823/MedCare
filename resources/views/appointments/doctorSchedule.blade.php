@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Appointment Schedule</h2>

        <div class="mb-3" style="display: flex">
            <a href="{{ route('appointments.schedule') }}" class="btn btn-primary">Today's Appointments</a>
            <a href="{{ route('doctor.schedule.monthly') }}" class="btn btn-secondary">This Month's Appointments</a>
            <a href="{{ route('doctor.schedule.year') }}" class="btn btn-info">All Appointments</a>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Patient</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                        <td>{{ $appointment->time_slot }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            @if ($appointment->feedback)
                                <span class="text-success">Feedback given</span>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#feedbackModal"
                                    data-feedback="{{ $appointment->feedback->feedback }}">
                                    <i class="fa-regular fa-file"></i>
                                </button>
                            @else
                                <span class="text-danger">No feedback</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="accepted"
                                    class="btn btn-success btn-sm">Accept</button>
                                <button type="submit" name="status" value="rejected"
                                    class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Patient Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="feedbackText">Loading...</p> <!-- Placeholder for feedback text -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to set feedback text in modal
        $('#feedbackModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var feedback = button.data('feedback'); // Extract info from data-* attributes

            // Log the feedback to the console for debugging
            console.log(feedback); // Check if feedback is being received correctly

            // Update the modal's content
            var modal = $(this);
            modal.find('#feedbackText').text(feedback ? feedback : 'No feedback available'); // Fallback text
        });
    </script>
@endsection
