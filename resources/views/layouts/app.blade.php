<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Anh Thơ Spa')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('imgs/logo.jpg') }}" alt="Logo" width="40" class="me-2">
                <span>Anh Thơ Spa</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Tổng quan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Báo cáo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Nhân viên</a></li>
                </ul>

                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item me-2"><a class="nav-link" href="#"><i class="fas fa-bell"></i></a></li>
                    <li class="nav-item me-2"><a class="nav-link" href="#"><i class="fas fa-gear"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-circle fa-lg"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('scripts')
</body>
</html>
