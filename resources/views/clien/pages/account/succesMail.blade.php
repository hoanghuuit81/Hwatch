@extends('clien.master')
@section('title', 'Succes')
@section('main')
     <!-- main-content-wrap start -->
     <div class="main-content-wrap section-ptb wishlist-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="search-error-wrapper">
                        <h2>Thông báo!</h2>
                        <p class="home-link">Chúng tôi đã gửi một mail xác nhận đến địa chỉ email <span>{{$mail}}</span>,bạn vui lòng kiếm tra hoặc ấn vào nút bên dưới để tiến hành đổi mật khẩu!!</p>
                        <a href="https://mail.google.com/" target="_blank" class="home-bacck-button">Xem mail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection