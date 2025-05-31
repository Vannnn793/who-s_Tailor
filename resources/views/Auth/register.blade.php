<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4 text-center">Register</h2>
        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="photo" class="form-label">Foto Profil:</label>
                <input type="file" name="photo" class="form-control" id="photo">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-select" id="role" required>
                    <option value="customer">Customer</option>
                    <option value="tailor">Tailor</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>

    @endsection
</body>
</html>
