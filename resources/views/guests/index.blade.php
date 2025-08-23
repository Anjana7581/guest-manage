<div class="container">
    <h1>Guests</h1>

    <a href="{{ route('guests.create') }}" class="btn btn-primary mb-3">Add Guest</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guests as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>
                        <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('guests.destroy', $guest) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No guests found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $guests->links() }}
</div>