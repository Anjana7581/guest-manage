@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
       <h4> <i class="fas fa-tachometer-alt me-2"></i> Dashboard</h4>
    </div>
    <div class="card-body">
        <h5 class="mb-3">Welcome back, {{ Auth::user()->name }} </h5>
    </div>
</div>
@endsection
