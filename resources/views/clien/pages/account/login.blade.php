@extends('clien.master')
@section('title', 'Login')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng nhập</li>
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
                            <a data-bs-toggle="tab" href="#lg1">
                                <h4> Đăng nhập </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('clien.postLogin') }}" method="post">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="text" name="email" placeholder="Email">
                                                @error('email')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                                <input type="password" name="password" placeholder="Mật khẩu">
                                                @error('password')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input name="remember" type="checkbox">
                                                    <label>Nhớ mật khẩu</label>
                                                    <a style="color: #212529" href="{{ route('clien.registerPage') }}">Đăng kí ngay!</a><br>
                                                    <a style="padding-top:5px" href="{{ route('clien.formForgetPass') }}">Quên mật khẩu?</a>
                                                </div>
                                                <div class="button-box">
                                                   
                                                    <button class="login-btn btn" type="submit"><span>Đăng
                                                            nhập</span></button>
                                                </div>
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
