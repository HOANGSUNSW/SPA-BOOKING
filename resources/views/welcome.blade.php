@extends('layouts.app')

@section('title', 'Trang chủ - Anh Thơ Spa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Xin chào!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bạn đã đăng nhập thành công vào hệ thống <strong>Đặt lịch Anh Thơ Spa</strong>!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
