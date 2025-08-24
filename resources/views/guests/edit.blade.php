@extends('layouts.app')

@section('title', 'Create Guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i> Create New Guest</h4>
                    </div>
                    <div class="card-body p-4">
                        @include('guests._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
