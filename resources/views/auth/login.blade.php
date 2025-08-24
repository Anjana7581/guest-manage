<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .login-card .card-header {
            background-color: #3b7ddd;
            color: #fff;
            font-weight: 600;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        .btn-primary {
            background-color: #3b7ddd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2f66b8;
        }
        .input-group-text {
            background: transparent;
            border-left: none;
            cursor: pointer;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #3b7ddd;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="card-header">
                <i class="fas fa-user-shield me-2"></i> Admin Login
            </div>
            <div class="card-body">
                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            class="form-control @error('email') is-invalid @enderror" 
                            required autofocus
                        >
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                required
                            >
                            <span class="input-group-text" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // toggle eye 
            const icon = this.querySelector("i");
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
