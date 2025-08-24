@extends('layouts.app')

@section('title', 'Guest Details')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-user me-2"></i> Guest Details</h4>
                    <a href="{{ route('guests.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>

                <div class="card-body p-4">

                    <!-- Basic Information  -->
                    <div class="mb-4">
                        <h5 class="text-secondary border-bottom pb-2 mb-3">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>Full Name:</strong> {{ $guest->name }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Email:</strong> {{ $guest->email ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Phone:</strong> {{ $guest->phone ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Address:</strong> {{ $guest->address ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                   <!-- Identification -->
                    <div class="mb-4">
                        <h5 class="text-secondary border-bottom pb-2 mb-3">Identification</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>ID Type:</strong> {{ $guest->id_proof_type ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>ID Number:</strong> {{ $guest->id_proof_number ?? 'N/A' }}
                            </div>
                            <div class="col-md-12 mt-3">
                                <strong>ID Proof:</strong><br>
                               @if($guest->id_proof_image)
                                    <div style="width: 300px; height: 200px; overflow: hidden; border: 1px solid #ddd; border-radius: 8px;">
                                        <img src="{{ Storage::url($guest->id_proof_image) }}" 
                                            alt="ID Image" 
                                            class="img-fluid" 
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <p>No ID image uploaded</p>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!--  Emergency Contact -->
                    <div class="mb-4">
                        <h5 class="text-secondary border-bottom pb-2 mb-3">Emergency Contact</h5>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>Name:</strong> {{ $guest->emergency_contact_name ?? 'N/A' }}
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Phone:</strong> {{ $guest->emergency_contact_phone ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info ---->
                    <div class="mb-4">
                        <h5 class="text-secondary border-bottom pb-2 mb-3">Additional Information</h5>
                        <p><strong>Special Requests:</strong> {{ $guest->special_requests ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                <a href="{{ route('guests.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back to Guests
                </a>

                <div class="d-flex">
                    <a href="{{ route('guests.edit', $guest) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('guests.destroy', $guest) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this guest?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>


            </div>
        </div>
    </div>
</div>
@endsection
