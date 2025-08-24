@extends('layouts.app')

@section('title', 'Manage Guests')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i> Guests</h4>
                    <a href="{{ route('guests.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-user-plus me-1"></i> Add Guest
                    </a>
                </div>

                <div class="card-body p-4">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead style="background: linear-gradient(120deg, #3b7ddd, #2a5ca0); color: white;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guests as $index => $guest)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('guests.destroy', $guest) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">No guests found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $guests->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
