<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Who’s Tailors') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .topbar {
            background-color: #b37700; /* Gold-brown */
            color: white;
            font-size: 0.9rem;
            padding: 5px 0;
        }
        .navbar-custom {
            background-color: #f5faff;
            padding: 15px 0;
        }
        .navbar-custom .nav-link {
            color: black;
            margin-right: 20px;
        }
        .navbar-custom .nav-link:hover {
            text-decoration: underline;
        }
        .auth-buttons .btn {
            margin-left: 10px;
        }
        .auth-buttons .btn-register {
            background-color: #b37700;
            color: white;
            border: none;
        }
        .auth-buttons .btn-login {
            border: 1px solid #b37700;
            color: #b37700;
            background: white;
        }

        .gallery {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        }
        .kos-item {
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
        }
        .kos-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .card-img-top:hover {
        transform: scale(1.05);
        transition: 0.3s;
        }

    </style>
</head>
<body>

    <!-- Top bar -->
    <div class="topbar text-white text-center text-md-start">
        <div class="container d-md-flex justify-content-between">
            <div>Penjahit terpercaya</div>
            <div>
                <i class="bi bi-envelope"></i> {{ Auth::user()->email ?? "" }} |
                <i class="bi bi-phone"></i> {{ Auth::user()->name ?? "" }}
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('logo.png') }}" alt="Logo" width="40"> Who’s Tailors
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" >Logout</a></li>
                </ul>
               
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
