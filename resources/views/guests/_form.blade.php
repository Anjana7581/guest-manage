@php
    $isEdit = isset($guest);
@endphp

<style>
    :root {
        --primary-color: #3b7ddd;
        --secondary-color: #6c757d;
        --success-color: #1cbb8c;
        --danger-color: #fc5b69;
        --warning-color: #f7b84b;
        --light-bg: #f5f8ff;
    }

    body {
        background-color: #f9fafb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
    }

    /* .card-header {
        background: linear-gradient(120deg, var(--primary-color), #2a5ca0);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 1.2rem 1.5rem;
    } */

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #344767;
    }

    .form-control, .form-select {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        border: 1px solid #d2d6da;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(59, 125, 221, 0.15);
    }

    .is-invalid {
        border-color: var(--danger-color);
    }

    .invalid-feedback {
        display: block;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .btn-primary {
        background: linear-gradient(120deg, var(--primary-color), #2a5ca0);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
    }

    .btn-outline-secondary {
        border-radius: 6px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .alert {
        border-radius: 8px;
        border: none;
    }

    .alert-danger {
        background-color: rgba(252, 91, 105, 0.15);
        color: var(--danger-color);
    }

    .alert-success {
        background-color: rgba(28, 187, 140, 0.15);
        color: #136f53;
    }

    .section-title {
        color: var(--primary-color);
        border-bottom: 2px solid var(--light-bg);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .info-text {
        font-size: 0.875rem;
        color: var(--secondary-color);
    }
</style>

@session('success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ $value }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> There are errors in your form</h5>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

   <form 
        method="POST" 
        action="{{ isset($guest) ? route('guests.update', $guest) : route('guests.store') }}" 
        enctype="multipart/form-data"
    >
        @csrf
        @if(isset($guest))
            @method('PUT')
        @endif

        <!-- Basic Information -->
        <h5 class="section-title">Basic Information</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputName">Full Name <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    name="name" 
                    id="inputName"
                    value="{{ old('name', $guest->name ?? '') }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter full name">
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputEmail">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    id="inputEmail"
                    value="{{ old('email', $guest->email ?? '') }}"
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Enter email address">
                @error('email')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputPhone">Phone Number</label>
                <input 
                    type="text" 
                    name="phone" 
                    id="inputPhone"
                    value="{{ old('phone', $guest->phone ?? '') }}"
                    class="form-control @error('phone') is-invalid @enderror" 
                    placeholder="Enter phone number">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputAddress">Address</label>
                <input 
                    type="text" 
                    name="address" 
                    id="inputAddress"
                    value="{{ old('address', $guest->address ?? '') }}"
                    class="form-control @error('address') is-invalid @enderror" 
                    placeholder="Enter full address">
                @error('address')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Identification Details -->
        <h5 class="section-title mt-4">Identification Details</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputIdType">ID Proof Type</label>
                <select 
                    name="id_proof_type" 
                    id="inputIdType"
                    class="form-select @error('id_proof_type') is-invalid @enderror">
                    <option value="">Select ID type</option>
                    @foreach(['Passport','Driver License','National ID','Other'] as $type)
                        <option value="{{ $type }}" {{ old('id_proof_type', $guest->id_proof_type ?? '') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
                @error('id_proof_type')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputIdNumber">ID Proof Number</label>
                <input 
                    type="text" 
                    name="id_proof_number" 
                    id="inputIdNumber"
                    value="{{ old('id_proof_number', $guest->id_proof_number ?? '') }}"
                    class="form-control @error('id_proof_number') is-invalid @enderror" 
                    placeholder="Enter ID number">
                @error('id_proof_number')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="inputIdImage">ID Proof Image</label>
            <input 
                type="file" 
                name="id_proof_image" 
                id="inputIdImage"
                class="form-control @error('id_proof_image') is-invalid @enderror">
            <div class="info-text">Upload a clear image of your ID (max 2MB)</div>
            @error('id_proof_image')
                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <!-- Emergency Contact -->
        <h5 class="section-title mt-4">Emergency Contact</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputEmergencyName">Emergency Contact Name</label>
                <input 
                    type="text" 
                    name="emergency_contact_name" 
                    id="inputEmergencyName"
                    value="{{ old('emergency_contact_name', $guest->emergency_contact_name ?? '') }}"
                    class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                    placeholder="Enter full name">
                @error('emergency_contact_name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="inputEmergencyPhone">Emergency Contact Phone</label>
                <input 
                    type="text" 
                    name="emergency_contact_phone" 
                    id="inputEmergencyPhone"
                    value="{{ old('emergency_contact_phone', $guest->emergency_contact_phone ?? '') }}"
                    class="form-control @error('emergency_contact_phone') is-invalid @enderror" 
                    placeholder="Enter phone number">
                @error('emergency_contact_phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Additional Information -->
        <h5 class="section-title mt-4">Additional Information</h5>
        <div class="mb-3">
            <label class="form-label" for="inputSpecialRequests">Special Requests</label>
            <textarea 
                name="special_requests" 
                id="inputSpecialRequests"
                class="form-control @error('special_requests') is-invalid @enderror" 
                rows="3"
                placeholder="Any special requests or notes">{{ old('special_requests', $guest->special_requests ?? '') }}</textarea>
            @error('special_requests')
                <div class="invalid-feedback"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('guests.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Guests
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> {{ isset($guest) ? 'Update Guest' : 'Create Guest' }}
            </button>
        </div>

    </form>
