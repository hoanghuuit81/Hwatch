@extends('clien.master')
@section('title', 'Cart')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Giỏ hàng</li>
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
                            <h2>Giỏ hàng của bạn không có sản phẩm nào</h2>
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
        <div class="main-content-wrap section-ptb cart-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('clien.updateCart') }}" method="POST" class="cart-table">
                            @csrf
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="plantmore-product-thumbnail">Ảnh</th>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="plantmore-product-price">Giá tiền</th>
                                            <th class="plantmore-product-quantity">Số lượng</th>
                                            <th class="plantmore-product-subtotal">Thành tiền</th>
                                            <th class="plantmore-product-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <td class="plantmore-product-thumbnail"><a
                                                        href="{{ route('clien.productDetail', $item->id) }}"><img
                                                            style="width:80px"
                                                            src="{{ asset('uploads') }}\{{ $item->options->image }}"
                                                            alt=""></a></td>
                                                <td class="plantmore-product-name"><a
                                                        href="{{ route('clien.productDetail', $item->id) }}">{{ $item->name }}</a>
                                                </td>
                                                <td class="plantmore-product-price"><span
                                                        class="amount">{{ number_format($item->price) }}đ</span></td>
                                                <td class="plantmore-product-quantity">
                                                    <input min="1" name="qty[{{ $item->rowId }}]"
                                                        value="{{ $item->qty }}" type="number">
                                                </td>
                                                <td class="product-subtotal"><span
                                                        class="amount">{{ number_format($item->price * $item->qty) }}</span>
                                                </td>
                                                <td class="plantmore-product-remove"><a
                                                        href="{{ route('clien.delCart', $item->rowId) }}"
                                                        onclick="confirmation(event)"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="coupon-all">

                                        <div class="coupon2">
                                            <input class="submit" name="update_cart" value="Cập nhật giỏ hàng"
                                                type="submit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Giá trị đơn hàng</h2>
                                        <ul>
                                            <li>Tổng đơn hàng <span>{{ Cart::subtotal() }}đ</span></li>
                                        </ul>
                                        <a href="{{ route('clien.formCheckOut') }}" class="proceed-checkout-btn">Hoàn tất đặt hàng</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-content-wrap end -->
    @endif

@endsection
