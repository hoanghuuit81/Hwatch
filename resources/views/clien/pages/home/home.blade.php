@extends('clien.master')
@section('title', 'Home')
@section('main')

        <!-- Hero Section Start -->
        <div class="hero-slider hero-slider-one">
            
            <!-- Single Slide End -->
            @foreach ($banners as $item)
                <!-- Single Slide Start -->
            <div class="single-slide" style="background-image: url({{ asset('uploads') }}/{{ $item->image }})">
                <!-- Hero Content One Start -->
                <div class="hero-content-one container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="slider-content-text text-left">
                                <h5>{{ $item->title }}</h5>
                                <h1>{{ $item->name }}</h1>
                                <p>{{ $item->description }}</p>
                                <p>Chỉ từ <strong>{{ number_format($item->price) }}đ</strong></p>
                                <div class="slide-btn-group">
                                    <a href="shop.html" class="btn btn-bordered btn-style-1">Mua sắm ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hero Content One End -->
            </div>
            <!-- Single Slide End -->
            @endforeach
            

        </div>
        <!-- Hero Section End -->
        
        <!-- Banner Area Start -->
        <div class="banner-area section-pt">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30">
                            <a href="#"><img src="{{ asset('clien/assets/images/banner/banner-01.jpg')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6  col-md-6">
                        <div class="single-banner mb-30">
                            <a href="#"><img src="{{ asset('clien/assets/images/banner/banner-02.jpg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->
       
        <!-- Product Area Start -->
        <div class="product-area section-pb section-pt-30">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h4>Sản phẩm bán chạy</h4>
                        </div>
                    </div>
                </div>
               
                <div class="row product-active-lg-4">
                    @foreach ($bestSellerPro as $item)
                    <div class="col-lg-12">
                        <!-- single-product-area start -->
                        <div class="single-product-area mt-30">
                            <div class="product-thumb">
                                <a href="{{route('clien.productDetail',$item->id)}}">
                                    <img class="primary-image" src="{{ asset('uploads') }}\{{ $item->image }}" alt="">
                                </a>
                                <div class="action-links">
                                    <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm vào giỏ hàng"><i class="icon-basket-loaded"></i></a>
                                    <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn" title="Thêm vào yêu thích"><i class="icon-heart"></i></a>
                                   
                                </div>
                            </div>
                            <div class="product-caption">
                                <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                <div class="price-box">
                                    <span class="new-price">{{ number_format($item->sale_price) }}đ</span>
                                    <span class="old-price">{{ number_format($item->price) }}đ</span>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-area end -->
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- Product Area End -->
        
        <!-- Banner Area Start -->
        <div class="banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30">
                            <a href="#"><img src="{{ asset('clien/assets/images/banner/banner-03.jpg')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6  col-md-6">
                        <div class="single-banner mb-30">
                            <a href="#"><img src="{{ asset('clien/assets/images/banner/banner-04.jpg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->
        
        
        <!-- Product Area Start -->
        <div class="product-area section-pb section-pt-30">
            <div class="container">
               
                <div class="row">
                    <div class="col-12 text-center">
                        <ul class="nav product-tab-menu" role="tablist">
                            <li class="product-tab-item nav-item active">
                                <a class="product-tab__link active" id="nav-featured-tab" data-bs-toggle="tab" href="#nav-featured" role="tab" aria-selected="true">Sản phẩm</a>
                            </li>

                            <li class="product-tab__item nav-item">
                                <a class="product-tab__link" id="nav-bestseller-tab" data-bs-toggle="tab" href="#nav-bestseller" role="tab" aria-selected="false">Bán chạy</a>
                            </li>

                        </ul>
                    </div>
                </div>
                
                
                <div class="tab-content product-tab__content" id="product-tabContent">
                    
                        
                    
                    <div class="tab-pane fade show active" id="nav-featured" role="tabpanel">
                        <div class="product-carousel-group">
                           
                            <div class="row product-active-row-4">
                                @foreach ($allPro as $item)
                                <div class="col-lg-12">
                                    <!-- single-product-area start -->
                                    <div class="single-product-area mt-30">
                                        <div class="product-thumb">
                                            <a href="{{route('clien.productDetail',$item->id)}}">
                                                <img class="primary-image" src="{{ asset('uploads') }}\{{ $item->image }}" alt="">
                                            </a>
                                            <div class="action-links">
                                                <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm vào giỏ hàng"><i class="icon-basket-loaded"></i></a>
                                                <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn" title="Thêm vào yêu thích"><i class="icon-heart"></i></a>
                                             
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">{{ number_format($item->sale_price) }}đ</span>
                                                <span class="old-price">{{ number_format($item->price) }}đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-area end -->
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="nav-bestseller" role="tabpanel">
                        <div class="product-carousel-group">
                           
                            <div class="row product-active-row-4">
                                @foreach ($bestSellerPro as $item)
                                <div class="col-lg-12">
                                    <!-- single-product-area start -->
                                    <div class="single-product-area mt-30">
                                        <div class="product-thumb">
                                            <a href="{{route('clien.productDetail',$item->id)}}">
                                                <img class="primary-image" src="{{ asset('uploads') }}\{{ $item->image }}" alt="">
                                            </a>
                                            <div class="action-links">
                                                <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm vào giỏ hàng"><i class="icon-basket-loaded"></i></a>
                                                <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn" title="Thêm vào yêu thích"><i class="icon-heart"></i></a>
                                               
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                            <div class="price-box">
                                                <span class="new-price">{{ number_format($item->sale_price) }}đ</span>
                                                <span class="old-price">{{ number_format($item->price) }}đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-area end -->
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    
                    
                   
                </div>
                
            </div>
        </div>
        <!-- Product Area End -->
        
        <!-- letast blog area Start -->
        <div class="letast-blog-area section-pb">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $item)
                    <div class="col-lg-4">
                        <div class="singel-latest-blog">
                            <div class="aritcles-content">
                                <div class="author-name">
                                    Đăng bởi: <a href="#"> {{ $item->author }}</a> - {{ date('d-m-Y', strtotime($item->created_at)) }}
                                </div>
                                <h4><a href="{{ route('clien.blogDetail',$item->id) }}" class="articles-name">{{ $item->title_blog }}</a></h4>
                            </div>
                            <div class="articles-image">
                                <a href="blog-details.html">
                                    <img src="{{ asset('uploads') }}\{{ $item->image }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
        <!-- letast blog area End -->
        
        <!-- our-brand-area start -->
        <div class="our-brand-area section-pb">
            <div class="container">
                <div class="row our-brand-active">
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                    <div class="brand-single-item">
                        <img src="{{ asset('clien/assets/images/brand/brand-01.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- our-brand-area end -->
       
        {{-- <div class="newletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="newletter-wrap">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-12">
                                    <div class="newsletter-title mb-30">
                                        <h3>Join Our <br><span>Newsletter Now</span></h3>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-7">
                                    <div class="newsletter-footer mb-30">
                                        <input type="text" placeholder="Your email address...">
                                        <div class="subscribe-button">
                                            <button class="subscribe-btn">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

@endsection