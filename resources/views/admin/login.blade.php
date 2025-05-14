@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        .login-container {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-control {
            background-color: rgb(255, 255, 255);
            color: dark;
            border: none;
            margin-bottom: 10px;
        }

        .form-control::placeholder {
            color: #d3d3d3;
        }

        .btn-login {
            background-color: #e0e0e0;
            color: black;
            border: none;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #c0c0c0;
        }

        .position-relative {
            position: relative;
        }

        .show-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #000;
            /* Adjust icon color as needed */
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <form method="POST" action="/post-login">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="nidn" placeholder="nidn" value="{{ old('nidn') }}" required>
                    @error('credential')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                    <i class="bi bi-eye-slash show-password" onclick="togglePassword()"></i>
                </div>
                <button type="submit" class="btn btn-login mt-3">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.querySelector('.show-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>

</html>
@endsection