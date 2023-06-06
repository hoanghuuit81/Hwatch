@extends('clien.master')
@section('title', 'Check out')
@section('main')
            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- breadcrumb-list start -->
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Trang đặt hàng</li>
                            </ul>
                            <!-- breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            @if (Cart::count() == 0)
                <!-- main-content-wrap start -->
                <div class="main-content-wrap section-ptb wishlist-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 text-center">
                                <div class="search-error-wrapper">
                                    <h2>Bạn không có sản phảm trong giỏ hàng</h2>
                                    <p class="home-link">Hãy quay lại trang chủ hoặc trang sản phẩm để mua sắm ngay!!</p>
                                    <a href="{{ route('clien.shop') }}" class="home-bacck-button">Mua sắm ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-content-wrap end -->
            @else
            <!-- main-content-wrap start -->
            <div class="main-content-wrap section-ptb checkout-page">
                <div class="container">
                    <!-- checkout-details-wrapper start -->
                    <div class="checkout-details-wrapper">
                        <form action="{{ route('clien.postCheckOut') }}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <!-- billing-details-wrap start -->
                                <div class="billing-details-wrap">
                                    
                                        <h3 class="shoping-checkboxt-title">Chi tiết thanh toán</h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="single-form-row">
                                                    <label>Tên của bạn <span class="required">*</span></label>
                                                    <input type="text" value="{{ Auth::guard('cus')->user()->name }}" name="name">
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="single-form-row">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="email" value="{{ Auth::guard('cus')->user()->email }}" name="email">
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p class="single-form-row">
                                                    <label>Địa chỉ <span class="required">*</span></label>
                                                    <input type="text" placeholder="Nhập địa chỉ chi tiết " value="{{ Auth::guard('cus')->user()->address }}" name="address">
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p class="single-form-row">
                                                    <label>Số điện thoại <span class="required">*</span></label>
                                                    <input type="number" value="{{ Auth::guard('cus')->user()->phone }}" name="phone">
                                                </p>
                                            </div>
                                            <div class="col-lg-12">
                                                <p class="single-form-row m-0">
                                                    <label>Ghi chú đơn hàng</label>
                                                    <textarea name="notes" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt cho giao hàng." class="checkout-mess" rows="2" cols="5"></textarea>
                                                </p>
                                            </div>
                                        </div>

                                   
                                </div>
                                <!-- billing-details-wrap end -->
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <!-- your-order-wrapper start -->
                                <div class="your-order-wrapper">
                                    <h3 class="shoping-checkboxt-title">Đơn hàng của bạn</h3>
                                    <!-- your-order-wrap start-->
                                    <div class="your-order-wrap">
                                        <!-- your-order-table start -->
                                        <div class="your-order-table table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Sản phẩm</th>
                                                        <th class="product-total">Tổng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Cart::content() as $item)
                                                        <tr class="cart_item">
                                                            <td class="product-name">
                                                                {{ $item->name }} <strong class="product-quantity"> × {{ $item->qty }}</strong>
                                                            </td>
                                                            <td class="product-total">
                                                                <span class="amount">{{ number_format($item->price * $item->qty) }}đ</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                                <tfoot>
                                                    <tr class="shipping">
                                                        <th>Phí vận chuyển</th>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    
                                                                    <label>Miễn phí vận chuyển</label>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng đơn hàng</th>
                                                        <td><strong><span class="amount">{{ Cart::subtotal() }}đ</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- your-order-table end -->
    
                                        <!-- your-order-wrap end -->
                                        <div class="payment-method">
                                            <div class="payment-accordion">
                                                <!-- ACCORDION START -->
                                                <h5>Lưu ý trước khi đặt hàng:</h5>
                                                <br>
                                                <div class="payment-content">
                                                    <p>- Kiểm tra lại toàn bộ đơn hàng, thông tin đơn hàng để đảm bảo chính xác</p>
                                                    <p>- Mọi thắc mắc xin liên hệ tới số điện thoại/zalo: 0899276830 </p>
                                                    
                                                </div>
                                            </div>
                                            <div class="order-button-payment">
                                                <input type="submit" value="Dặt hàng" />
                                            </div>
                                        </div>
                                        <!-- your-order-wrapper start -->
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- checkout-details-wrapper end -->
                </div>
            </div>
            <!-- main-content-wrap end -->
            @endif
@endsection