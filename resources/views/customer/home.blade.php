@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>💅 Welcome to Anh Tho Spa!</h2>
    <p>Bạn có thể đặt lịch, xem ưu đãi và đánh giá dịch vụ tại đây.</p>
    <a href="{{ route('logout') }}" class="btn btn-danger">Đăng xuất</a>
</div>
@endsection
