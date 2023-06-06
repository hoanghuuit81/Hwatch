@extends('clien.master')
@section('title', 'Register')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng kí</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb lagin-and-register-page">
        <div class="container">
            @if (session('flash'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Thông báo: </strong>
                    {{ session('flash') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <strong>Thông báo: </strong>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-7 col-md-12 m-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4> Đăng kí </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('clien.register') }}" method="post">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="text" value="{{ old('name') }}" name="name" placeholder="Tên của bạn">
                                                @error('name')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="text" value="{{ old('address') }}" name="address" placeholder="Địa chỉ của bạn">
                                                @error('address')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="number" value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại">
                                                @error('phone')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="text" value="{{ old('email') }}" name="email" placeholder="Email">
                                                @error('email')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="password" value="{{ old('password') }}" name="password" placeholder="Mật khẩu">
                                                @error('password')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="password" value="{{ old('confirmPass') }}" name="confirmPass" placeholder="Nhập lại mật khẩu">
                                                @error('confirmPass')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror

                                            </div>
                                            <div class="button-box">
                                                <button class="register-btn btn" type="submit"><span>Đăng
                                                        kí</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection
