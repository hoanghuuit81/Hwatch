@extends('clien.master')
@section('title', 'Thanks')
@section('main')
     <!-- main-content-wrap start -->
     <div class="main-content-wrap section-ptb wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="search-error-wrapper">
                        <h2>Đặt hàng thành công!</h2>
                        <p class="home-link">Cảm ơn bạn đã tin tưởng và ủng hộ cửa hàng!!</p>
                        <a href="{{ route('clien.index') }}" class="home-bacck-button">Quay lại trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection