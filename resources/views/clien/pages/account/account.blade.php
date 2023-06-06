@extends('clien.master')
@section('title', 'Home')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tài khoản của tôi</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb my-account-page">
        <div class="container">
            @if (session('flash'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Thông báo: </strong>
                    {{ session('flash') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="account-dashboard">
                        @if (Auth::guard('cus')->check())
                            <div class="dashboard-upper-info">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="d-single-info">
                                            <p class="user-name">Xin chào
                                                <span>{{ Auth::guard('cus')->user()->name }}</span></p>
                                            <p>({{ Auth::guard('cus')->user()->email }})</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="d-single-info">
                                            <p>{{ Auth::guard('cus')->user()->address }}</p>
                                            <p>{{ Auth::guard('cus')->user()->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="d-single-info">
                                            <p>Liên hệ hỗ trợ </p>
                                            <p>hoanghuulopb@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <div class="d-single-info text-lg-center">
                                            <a href="cart.html" class="view-cart"><i class="fa fa-cart-plus"></i>Giỏ
                                                hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <!-- Nav tabs -->
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">Điều khiển</a>
                                    </li>
                                    @if (Auth::guard('cus')->check())
                                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">Đơn hàng</a></li>
                                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Chi tiết tài
                                                khoản</a></li>
                                    @endif


                                    @if (Auth::guard('cus')->check())
                                        <li><a href="{{ route('clien.logout') }}" class="nav-link">Logout</a></li>
                                    @else
                                        <li><a href="{{ route('clien.login') }}" class="nav-link">login</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-10">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane active" id="dashboard">
                                        <h3>Điều khiển </h3>
                                        <p>Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ dàng kiểm tra và xem các đơn
                                            đặt hàng gần đây của mình, quản lý địa chỉ giao hàng và thanh toán cũng như
                                            chỉnh sửa mật khẩu và chi tiết tài khoản của bạn.</p>
                                    </div>
                                    <div class="tab-pane fade" id="orders">
                                        <h3>Đơn hàng</h3>
                                        @if (!Auth::guard('cus')->check() ||  $orders->count()==0)
                                            <h5>Không có đơn hàng nào!</h5>
                                            <p>Bạn cần đăng nhập hoặc <a href="{{ route('clien.shop') }}" style="font-weight: bold">MUA </a> sản phẩm ngay</p>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Đơn hàng</th>
                                                        <th>Ngày đặt</th>
                                                        <th>Trạng thái</th>
                                                        <th>Tổng</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @foreach ($orders as $item)
                                                        <tr>
                                                            <td>{{ $item->code_order }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->created_at))  }}</td>
                                                           @if ($item->status == 0)
                                                                <td style="color: #dc3545" >Đang xử lý</td>
                                                            
                                                           @elseif($item->status == 1)
                                                                <td style="color: #ffc107">Chờ lấy hàng</td>
                                                            
                                                           @elseif($item->status == 2)
                                                                <td style="color: #17a2b8">Đang giao</td>
                                                            
                                                           @else
                                                                <td style="color: #28a745">Đã giao</td>
                                                            
                                                           @endif
                                                            <td>{{ number_format($item->total_amount) }} </td>
                                                            <td><a href="cart.html" class="view">Xem</a></td>
                                                        </tr>

                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        
                                    </div>
                                    @if (Auth::guard('cus')->check())
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Chi tiết tài khoản </h3>
                                        <div class="login">
                                            <div class="login-form-container">
                                                <div class="account-login-form">
                                                    <form action="{{ route('clien.cusUpdate', Auth::guard('cus')->user()->id) }}" method="post">
                                                        @csrf
                                                        <div class="account-input-box">
                                                            <label>Họ và tên</label>
                                                            <input type="text"
                                                                value="{{ Auth::guard('cus')->user()->name }}"
                                                                name="name">
                                                            @error('name')
                                                                <p style="color: red">{{ $message }}</p>
                                                            @enderror
                                                            <label>Địa chỉ</label>
                                                            <input type="text"
                                                                value="{{ Auth::guard('cus')->user()->address }}"
                                                                name="address">
                                                            @error('address')
                                                                <p style="color: red">{{ $message }}</p>
                                                            @enderror
                                                            <label>Số điện thoại</label>
                                                            <input type="number"
                                                                value="{{ Auth::guard('cus')->user()->phone }}"
                                                                name="phone">
                                                            @error('phone')
                                                                <p style="color: red">{{ $message }}</p>
                                                            @enderror
                                                            <label>Email</label>
                                                            <input type="text"  value="{{ Auth::guard('cus')->user()->email }}" name="email">
                                                            @error('email')
                                                                <p style="color: red">{{ $message }}</p>
                                                            @enderror
                                                            <label>Mật khẩu mới(Không bắt buộc)</label>
                                                            <input type="password" name="password">

                                                        </div>
                                                        <div class="button-box">
                                                            <button class="btn default-btn" type="submit">Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
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
