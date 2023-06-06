@extends('clien.master')
@section('title', 'Contact Us')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Liên hệ</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Page Conttent -->
    <main class="page-content section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form">
                        <div class="contact-form-info">
                            <div class="contact-title">
                                <h3>Nói với chúng tôi về ý kiến của bạn</h3>
                            </div>
                            <form action="{{ route('clien.postContact') }}" method="post">
                                @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        @if (Auth::guard('cus')->check())
                                            <div class="contact-inner">
                                                <input name="name" value="{{ Auth::guard('cus')->user()->name }}"
                                                    type="text" placeholder="Tên *">
                                            </div>
                                            @error('name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <div class="contact-inner">
                                                <input name="name" type="text" value="{{ old('name') }}"
                                                    placeholder="Tên *">
                                            </div>
                                            @error('name')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @endif

                                        @if (Auth::guard('cus')->check())
                                            <div class="contact-inner">
                                                <input name="email" value="{{ Auth::guard('cus')->user()->email }}"
                                                    type="email" placeholder="Email *">
                                            </div>
                                            @error('email')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <div class="contact-inner">
                                                <input name="email" type="email" value="{{ old('email') }}"
                                                    placeholder="Email *">
                                            </div>
                                            @error('email')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @endif
                                        @if (Auth::guard('cus')->check())
                                            <div class="contact-inner">
                                                <input name="phone" value="{{ Auth::guard('cus')->user()->phone }}"
                                                    type="number" placeholder="Số điện thoại *">
                                            </div>
                                            @error('phone')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <div class="contact-inner">
                                                <input name="phone" type="number" value="{{ old('phone') }}"
                                                    placeholder="Số điện thoại *">
                                            </div>
                                            @error('phone')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                        @endif

                                        <div class="contact-inner">
                                            <input name="subject" value="{{ old('subject') }}" type="text"
                                                placeholder="Chủ đề *">
                                        </div>
                                        @error('subject')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                        <div class="contact-inner contact-message">
                                            <textarea name="content" placeholder="Nội dung *">{{ old('content') }}</textarea>
                                        </div>
                                        @error('content')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button class="submit-btn" type="submit">Gửi Email</button>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-infor">
                        <div class="contact-title">
                            <h3>Liên hệ với chúng tôi</h3>
                        </div>
                        <div class="contact-dec">
                            <p>Chúng tôi rất mong nhận được ý kiến và góp ý từ mọi người về Hwatch để chúng tôi có thể ngày
                                càng cải thiện và mang đến trải nghiệm mua sắm tốt nhất cho khách hàng.</p>
                        </div>
                        <div class="contact-address">
                            <ul>
                                <li>Địa chỉ : My Dinh - Ha Noi</li>
                                <li>Email: taisaokhong81@gmail.com</li>
                                <li>Số điện thoại: 0899276830</li>
                            </ul>
                        </div>
                        <div class="work-hours">
                            <h5>Giờ làm việc</h5>
                            <p><strong>Thứ hai &ndash; Thứ bảy</strong>: &nbsp;08AM &ndash; 22PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->
@endsection
