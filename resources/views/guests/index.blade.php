@extends('layouts.app')

@section('title', 'Manage Guests')

@section('content')
<div class="container-fluid px-2 px-md-4 ">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
               <div class="card-header d-flex justify-content-between align-items-center">     
                    <h4 class="mb-0 text-center text-md-start"><i class="fas fa-users me-2"></i> Guests</h4>
                    <a href="{{ route('guests.create') }}" class="btn btn-sm btn-light w-md-auto">
                        <i class="fas fa-user-plus me-1"></i> Add Guest
                    </a>
                </div>

                <div class="card-body p-3 p-md-4">

                    @if(session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                         <script>
                            setTimeout(() => {
                                let alert = document.getElementById('success-alert');
                                if (alert) {
                                    let bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }
                            }, 3000); 
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead style="background: linear-gradient(120deg, #3b7ddd, #2a5ca0); color: white;">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guests as $index => $guest)
                                    <tr>
                                        <td>{{ ($guests->currentPage() - 1) * $guests->perPage() + $loop->iteration }}</td>
                                        <td>{{ $guest->name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone }}</td>
                                        <td class="text-center">
                                           <div class="d-flex flex-wrap justify-content-center gap-1">
                                            <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-outline-warning shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                             <a href="{{ route('guests.show', $guest) }}" class="btn btn-sm btn-outline-primary shadow-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('guests.destroy', $guest) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger shadow-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            </div>
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

                <!---- Pagination ---->
                <div class="mt-4 d-flex justify-content-end justify-content-md-end">
                    {{ $guests->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>

                <style>
                    .pagination {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 6px;
                        list-style: none;
                        padding-left: 0;
                    }

                    .page-item .page-link {
                        border-radius: 8px;
                        padding: 6px 12px;
                        color: #2a5ca0;
                        border: 1px solid #dee2e6;
                        transition: all 0.2s ease;
                    }

                    .page-item .page-link:hover {
                        background: #3b7ddd;
                        color: #fff;
                        border-color: #3b7ddd;
                    }

                    .page-item.active .page-link {
                        background: linear-gradient(120deg, #3b7ddd, #2a5ca0);
                        border-color: #2a5ca0;
                        color: #fff;
                        font-weight: bold;
                    }
                </style>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
