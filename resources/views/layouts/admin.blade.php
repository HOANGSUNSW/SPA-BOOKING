    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Anh Thơ Spa')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom style stack -->
        @stack('styles')
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

                        <li class="nav-item">
                            <a href="#" class="nav-link active">Tổng quan</a>
                        </li>

                        {{-- Dropdown Khách hàng --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="khDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Khách hàng
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="khDropdown">
                                <li><a class="dropdown-item" href="#">Ưu đãi</a></li>
                                <li><a class="dropdown-item" href="#">Khuyến mãi</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.customers') }}">Khách hàng</a></li>
                            </ul>
                        </li>

                        {{-- Dropdown Nhân viên --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="nvDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Nhân viên
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="nvDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.staff') }}">Quản lý nhân viên</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.workschedules') }}">Lịch làm việc</a></li>
                                <li><a class="dropdown-item" href="#">Bảng chấm công</a></li>
                            </ul>
                        </li>
                        {{-- Dropdown dịch vụ  --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="nvDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dịch vụ
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="nvDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.staff') }}">Quản lý dịch vụ</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.workschedules') }}">Liệu trình</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">Đặt lịch</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Báo cáo</a></li>
                    </ul>

                    <!-- Right icons -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#"><i class="fas fa-gear"></i></a>
                        </li>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn border-0 bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="width: 36px; height: 36px;">
                                <i class="fa-solid fa-user text-primary fs-5"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm py-2"
                                aria-labelledby="userDropdown"
                                style="min-width: 180px; border-radius: 10px;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                        <i class="fa-regular fa-user me-2 text-secondary"></i> Tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                        <i class="fa-solid fa-store me-2 text-secondary"></i> Thông tin gian hàng
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center text-danger py-2">
                                            <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Script stack -->
        @stack('scripts')
    </body>
    </html>
