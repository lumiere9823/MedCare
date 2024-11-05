@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Medications</h2>

        <div class="row">
            @foreach ($medications as $medication)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $medication->name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($medication->description, 50) }}</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#medicationModal{{ $medication->medication_id }}">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Medication Modal -->
                <div class="modal fade" id="medicationModal{{ $medication->medication_id }}" tabindex="-1"
                    aria-labelledby="medicationModalLabel{{ $medication->medication_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="medicationModalLabel{{ $medication->medication_id }}">
                                    {{ $medication->name }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Description:</strong> {{ $medication->description }}</p>
                                <p><strong>Price:</strong> ${{ number_format($medication->price, 2) }}</p>
                                <p><strong>Stock Quantity:</strong> {{ $medication->stock_quantity }}</p>
                                <p><strong>Supplier:</strong> {{ $medication->supplier->name ?? 'Unknown' }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
