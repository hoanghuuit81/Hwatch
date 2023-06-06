<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.net/ruiz/ruiz/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Apr 2023 14:58:54 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('clien/assets/images/favicon.ico') }}">

    <!-- CSS
 ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('clien/assets/css/vendor/bootstrap.min.css') }}">
    <!-- Sweet alert CSS -->
    <link rel="stylesheet" href="{{ asset('clien/assets/package/dist/sweetalert2.min.css')}}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('clien/assets/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/vendor/simple-line-icons.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/fancy-box.css') }}">
    <link rel="stylesheet" href="{{ asset('clien/assets/css/plugins/jqueryui.min.css') }}">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->

    {{-- <script src="{{ asset('clien/assets/js/vendor/vendor.min.js')}}"></script>
    <script src="{{ asset('clien/assets/js/plugins/plugins.min.js')}}"></script> --}}


    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="{{ asset('clien/assets/css/style.css') }}">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->

</head>

<body>

    <div class="main-wrapper">

        <!--  Header Start -->
        <header class="header">

            <!-- Header Top Start -->
            <div class="header-top-area d-none d-lg-block text-color-white bg-gren border-bm-1">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center">
                                    <li class="language">Tiếng việt

                                    </li>
                                    @if (Auth::guard('cus')->check())
                                        <li class="curreny-wrap">Xin chào: {{ Auth::guard('cus')->user()->name }}

                                        </li>
                                    @else
                                        <li class="curreny-wrap">Chưa đăng nhập

                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="top-info-wrap text-end">
                                <ul class="my-account-container">
                                    <li><a href="{{ route('clien.account') }}">Tài khoản</a></li>
                                    <li><a href="{{ route('clien.cart') }}">Giỏ hàng</a></li>
                                    <li><a href="{{ route('clien.favoriteIndex') }}">Yêu thích</a></li>
                                    <li><a href="{{ route('clien.formCheckOut') }}">Thanh toán</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Header Top End -->

            <!-- haeader Mid Start -->
            <div class="haeader-mid-area bg-gren border-bm-1 d-none d-lg-block ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 col-5">
                            <div class="logo-area">
                                <a href="{{route('clien.index')}}"><img src="{{ asset('clien/assets/images/logo/logo.png') }}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="search-box-wrapper">
                                <div class="search-box-inner-wrap" style="position: relative">
                                    <form class="search-box-inner">
                                        <div class="search-field-wrap">
                                            <input type="text" name="key" class="search-field input-search-ajax"
                                                placeholder="Tìm kiến sản phẩm...">
                                        </div>
                                    </form>
                                    <div class="search-ajax" style="position: absolute; z-index:1">
                                        
                                        

                                    </div>
                                 </div>
                             </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="right-blok-box text-white d-flex">
        
                                <div class="user-wrap">
                                    <a href="{{ route('clien.favoriteIndex') }}"><span class="cart-total">{{ $totalFavorites }}</span> <i class="icon-heart"></i></a>
                                </div>

                                @if (Cart::count() == 0)
                                <div class="shopping-cart-wrap">
                                    <a href="{{ route('clien.cart') }}"><i class="icon-basket-loaded"></i><span class="cart-total">{{Cart::count()}}</span></a>
                                    <ul class="mini-cart">
                                        
                                            <div class="subtotal-title">
                                                <h5>Giỏ hàng trống!</h5>
                                            </div>
                                        
                                        <li class="mini-cart-btns">
                                            <div class="cart-btns">
                                                <a href="{{ route('clien.shop') }}">Mua ngay</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                <div class="shopping-cart-wrap">
                                    <a href="{{ route('clien.cart') }}"><i class="icon-basket-loaded"></i><span class="cart-total">{{Cart::count()}}</span></a>
                                    <ul class="mini-cart">
                                        @foreach (Cart::content() as $item)
                                        <li class="cart-item">
                                            <div class="cart-image">
                                                <a href="{{ route('clien.productDetail',$item->id) }}"><img alt="" src="{{ asset('uploads') }}\{{ $item->options->image }}"></a>
                                            </div>
                                            <div class="cart-title">
                                                <a href="{{ route('clien.productDetail',$item->id) }}">
                                                    <h4>{{ $item->name }}</h4>
                                                </a>
                                                <div class="quanti-price-wrap">
                                                    <span class="quantity">{{$item->qty}} ×</span>
                                                    <div class="price-box"><span class="new-price">{{ number_format($item->price) }}đ</span></div>
                                                </div>
                                                <a class="remove_from_cart" href="{{ route('clien.delCart',$item->rowId) }}"><i class="icon_close"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                        <li class="subtotal-box">
                                            <div class="subtotal-title">
                                                <h3>Tổng cộng :</h3><span>{{ Cart::subtotal() }}đ</span>
                                            </div>
                                        </li>
                                        <li class="mini-cart-btns">
                                            <div class="cart-btns">
                                                <a href="{{ route('clien.cart') }}">Xem giỏ hàng</a>
                                                <a href="{{ route('clien.formCheckOut') }}">Thanh toán</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
        
                                
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
    </div>
    </div>
    <!-- haeader Mid End -->

    <!-- haeader bottom Start -->
    <div class="haeader-bottom-area bg-gren header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 d-none d-lg-block">
                    <div class="main-menu-area white_text">
                        <!--  Start Mainmenu Nav-->
                        <nav class="main-navigation text-center">
                            <ul>
                                <li class="active"><a href="{{ route('clien.index') }}">Trang chủ</a>

                                </li>

                                <li><a href="{{ route('clien.shop') }}">Sản phẩm</a>


                                </li>
                                <li><a href="{{ route('clien.blog') }}">Bài viết</a>
                                </li>
                                <li><a href="{{ route('clien.about') }}">Về chúng tôi</a></li>
                                <li><a href="{{ route('clien.contact') }}">Liên hệ</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>

                <div class="col-5 col-md-6 d-block d-lg-none">
                    <div class="logo"><a href="{{ route('clien.index') }}"><img
                                src="{{ asset('clien/assets/images/logo/logo.png') }}" alt=""></a></div>
                </div>


                <div class="col-lg-3 col-md-6 col-7 d-block d-lg-none">
                    <div class="right-blok-box text-white d-flex">

                        <div class="user-wrap">
                            <a href="{{ route('clien.favoriteIndex') }}"><span class="cart-total">{{ $totalFavorites }}</span> <i class="icon-heart"></i></a>
                        </div>

                        <div class="shopping-cart-wrap">
                            <a href="{{ route('clien.cart') }}"><i class="icon-basket-loaded"></i><span class="cart-total">{{Cart::count()}}</span></a>
                            <ul class="mini-cart">
                                @foreach (Cart::content() as $item)
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="{{ route('clien.productDetail',$item->id) }}"><img alt=""
                                                src="{{ asset('uploads') }}\{{ $item->options->image }}"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="{{ route('clien.productDetail',$item->id) }}">
                                            <h4>{{ $item->name }}</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">{{$item->qty}} ×</span>
                                            <div class="price-box"><span class="new-price">{{ number_format($item->price) }}đ</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="{{ route('clien.delCart',$item->rowId) }}"><i class="fa fa-times"></i></a>
                                    </div>
                                </li>
                                @endforeach
                                <li class="subtotal-box">
                                    <div class="subtotal-title">
                                        <h3>Tổng cộng :</h3><span>{{ Cart::subtotal() }}đ</span>
                                    </div>
                                </li>
                                <li class="mini-cart-btns">
                                    <div class="cart-btns">
                                        <a href="{{ route('clien.cart') }}">Xem giỏ hàng</a>
                                        <a href="{{ route('clien.formCheckOut') }}">Thanh toán</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mobile-menu-btn d-block d-lg-none">
                            <div class="off-canvas-btn">
                                <a href="#"><img src="{{ asset('clien/assets/images/icon/bg-menu.png') }}"
                                        alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- haeader bottom End -->

    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="fa fa-times"></i>
            </div>

            <div class="off-canvas-inner">

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{ route('clien.index') }}">Trang chủ</a>

                            </li>
                            <li class="menu-item-has-children"><a href="{{ route('clien.shop') }}">Sản phẩm</a>

                            </li>
                            <li class="menu-item-has-children "><a href="{{ route('clien.blog') }}">Bài viết</a>

                            </li>
                            <li><a href="{{ route('clien.about') }}">Về chúng tôi</a></li>
                            <li><a href="{{ route('clien.contact') }}">Liên hệ</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->


                <div class="header-top-settings offcanvas-curreny-lang-support">
                    <h5>Tài khoản</h5>
                    @if (Auth::guard('cus')->check())
                        <ul class="nav align-items-center">
                            <li class="curreny-wrap">Xin chào {{ Auth::guard('cus')->user()->name }}

                            </li>
                        </ul>
                    @else
                        <ul class="nav align-items-center">
                            <li class="curreny-wrap">Chưa đăng nhập

                            </li>
                        </ul>
                    @endif

                </div>

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="top-info-wrap text-left text-black">
                        <h5>Tài khoản của tôi</h5>
                        <ul class="offcanvas-account-container">
                            <li><a href="{{ route('clien.account') }}">Tài khoản của tôi</a></li>
                            <li><a href="{{ route('clien.cart') }}">Giỏ hàng</a></li>
                            <li><a href="{{ route('clien.favoriteIndex') }}">Yêu thích</a></li>
                            <li><a href="{{ route('clien.formCheckOut') }}">Mua hàng</a></li>
                        </ul>
                    </div>

                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->

    </header>
    <!--  Header Start -->
