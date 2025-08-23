<div class="container">
    <h1>Edit Guest</h1>

    <form action="{{ route('guests.update', $guest) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $guest->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $guest->email }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $guest->phone }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('guests.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>