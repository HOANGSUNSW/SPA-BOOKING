<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Anh Thơ Spa - Chăm sóc sắc đẹp chuyên nghiệp')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .navbar-brand {
            font-weight: bold;
            color: #c77dff !important;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }

        .card-service:hover {
            transform: scale(1.02);
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-purple {
            background-color: #c77dff;
            color: white;
        }

        .btn-purple:hover {
            background-color: #9d4edd;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-spa"></i> Anh Thơ Spa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Dịch vụ</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Combo</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Khuyến mãi</a></li>
                </ul>

                <!-- User Section -->
                <ul class="navbar-nav">
                    @if (session('jwt_token') && session('user_name'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Xin chào,
                                <strong>&nbsp;{{ session('user_name') }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href=""><i class="fas fa-chart-line me-2"></i>Bảng
                                        điều khiển</a></li>
                                <li><a class="dropdown-item" href=""><i
                                            class="fas fa-calendar-check me-2"></i>Lịch hẹn của tôi</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Đăng ký
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về Anh Thơ Spa</h5>
                    <p>Chuyên cung cấp các dịch vụ chăm sóc da, massage, liệu trình trị liệu uy tín và chuyên nghiệp tại
                        TP.HCM.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-phone"></i> 0961 234 567</p>
                    <p><i class="fas fa-envelope"></i> cskh@anhthospa.vn</p>
                    <p><i class="fas fa-map-marker-alt"></i> 45 Nguyễn Đình Chiểu, Q.3, TP.HCM</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-2x"></i></a>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p>&copy; 2025 Anh Thơ Spa. Bản quyền đã được bảo hộ.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
