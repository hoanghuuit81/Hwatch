@extends('clien.master')
@section('title', 'Detail')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-ptb">
        <div class="container">
            <div class="row product-details-inner">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-large-slider">
                        <div class="pro-large-img img-zoom">
                            <img src="{{ asset('uploads') }}/{{ $pro->image }}" alt="product-details" />
                            <a href="{{ asset('uploads') }}/{{ $pro->image }}" data-fancybox="images"><i class="fa fa-search"></i></a>
                        </div>
                        @foreach ($pro->detailImages as $item)
                            <div class="pro-large-img img-zoom">
                                <img src="{{ asset('uploads') }}/{{ $item->image }}" alt="product-details" />
                                <a href="{{ asset('uploads') }}/{{ $item->image }}" data-fancybox="images"><i class="fa fa-search"></i></a>
                            </div>
                        @endforeach
                        

                    </div>
                    <div class="product-nav">
                        <div class="pro-nav-thumb">
                            <img src="{{ asset('uploads') }}/{{ $pro->image }}" alt="product-details" />
                        </div>
                        @foreach ($pro->detailImages as $item)
                            <div class="pro-nav-thumb">
                                <img src="{{ asset('uploads') }}/{{ $item->image }}" alt="product-details" />
                            </div>
                        @endforeach
                        
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h3>{{ $pro->name }}</h3>
                            {{-- <div class="product-rating d-flex">
                                <ul class="d-flex">
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                                <a href="#reviews">(<span class="count">1</span> customer review)</a>
                            </div> --}}
                            <div class="price-box">
                                <span class="new-price">{{ number_format($pro->sale_price) }}đ</span>
                                <span class="old-price">{{ number_format($pro->price) }}đ</span>
                            </div>
                            <div>{!! htmlspecialchars_decode($pro->description) !!}</div>
                            <br>

                            <div class="single-add-to-cart">
                                <form action="{{ route('clien.addCart',$pro->id) }}" class="cart-quantity d-flex">
                                    @csrf
                                    <div class="quantity">
                                        <div class="cart-plus-minus">
                                            <input type="number" class="input-text" name="quantity" value="1" title="Qty">
                                        </div>
                                    </div>
                                    <button class="add-to-cart" type="submit">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                            <ul class="single-add-actions">
                                <li class="add-to-wishlist">
                                    <a href="{{ route('clien.addFavorite',$item->id) }}" class="add_to_wishlist"><i class="icon-heart"></i> Thêm vào yêu thích</a>
                                </li>
                               
                            </ul>
                            <ul class="stock-cont">
                                <li class="product-stock-status">Danh mục: <a href="#">{{ $pro->category->name }}</a></li>
                            </ul>
                            <div class="share-product-socail-area">
                                <p>Chia sẻ sản phẩm</p>
                                <ul class="single-product-share">

                                    <div id="fb-root"></div>
                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="gplvHOcT"></script>
                                    <div class="fb-share-button" data-href="{{ $url }}" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-description-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-tab">
                            <ul role="tablist" class="nav">
                                <li class="active" role="presentation">
                                    <a data-bs-toggle="tab" role="tab" href="#description" class="active">Mô tả</a>
                                </li>
                                <li role="presentation">
                                    <a data-bs-toggle="tab" role="tab" href="#reviews">Bình luận</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product_details_tab_content tab-content">
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                                <div class="product_description_wrap  mt-30">
                                    <div class="product_desc mb-30">
                                        {!! htmlspecialchars_decode($pro->description) !!}
                                    </div>

                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                                <div class="review_address_inner mt-30">
                                    <!-- Start Single Review -->
                                    @foreach ($comments as $item)
                                        <div class="pro_review">
                                            <div class="review_thumb">
                                                <img alt="review images" style="max-width:50px" src="{{ asset('clien/assets/images/other/user.jfif')}}">
                                            </div>
                                            <div class="review_details">
                                                <div class="review_info mb-10">
                                                    
                                                    <h5>{{ $item->name }} - <span> {{ $item->created_at }}</span></h5>

                                                </div>
                                                <p>{{ $item->content }}</p>
                                            </div>
                                        </div>
                                    @endforeach  
                                    <!-- End Single Review -->
                                </div>
                                <!-- Start RAting Area -->
                                <div class="rating_wrap mt-50">
                                    <h5 class="rating-title-1">Thêm bình luận </h5>
                                    <p>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</p>
                                </div>
                                <!-- End RAting Area -->
                                <div class="comments-area comments-reply-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="{{ route('clien.postComment',$pro->id) }}" method="POST" class="comment-form-area">
                                                @csrf
                                                <div class="row comment-input">
                                                    @if (Auth::guard('cus')->check())
                                                        <div class="col-md-6 comment-form-author mt-15">
                                                            <label>Tên <span class="required">*</span></label>
                                                            <input type="text" value="{{ Auth::guard('cus')->user()->name }}" required="required" name="name">
                                                        </div>
                                                        <div class="col-md-6 comment-form-email mt-15">
                                                            <label>Email <span class="required">*</span></label>
                                                            <input type="text" value="{{ Auth::guard('cus')->user()->email }}" required="required" name="email">
                                                        </div>
                                                    @else
                                                        <div class="col-md-6 comment-form-author mt-15">
                                                            <label>Tên <span class="required">*</span></label>
                                                            <input type="text" required="required" name="name">
                                                        </div>
                                                        <div class="col-md-6 comment-form-email mt-15">
                                                            <label>Email <span class="required">*</span></label>
                                                            <input type="text" required="required" name="email">
                                                        </div>
                                                    @endif
                                                   
                                                    
                                                </div>
                                                <div class="comment-form-comment mt-15">
                                                    <label>Nội dung</label>
                                                    <textarea class="comment-notes" name="content" required="required"></textarea>
                                                </div>
                                                <div class="comment-form-submit mt-15">
                                                    <input type="submit" value="Xong" class="comment-submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="related-product-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3> Sản phẩm liên quan</h3>
                        </div>
                    </div>
                </div>
                <div class="row product-active-lg-4">
                    @foreach ($relatedPro as $item)
                    <div class="col-lg-12">
                        <!-- single-product-area start -->
                        <div class="single-product-area mt-30">
                            <div class="product-thumb">
                                <a href="{{route('clien.productDetail',$item->id)}}">
                                    <img class="primary-image" src="{{ asset('uploads') }}/{{ $item->image }}" alt="">
                                </a>
                                <div class="action-links">
                                    <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm giỏ hàng"><i class="icon-basket-loaded"></i></a>
                                    <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn" title="Thêm yêu thích"><i class="icon-heart"></i></a>
                                    
                                </div>
                            </div>
                            <div class="product-caption">
                                <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                <div class="price-box">
                                    <span class="new-price">{{ number_format($pro->sale_price) }}đ</span>
                                    <span class="old-price">{{ number_format($pro->sale_price) }}đ</span>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-area end -->
                    </div>
                    @endforeach
                    
                </div>
            </div>

            <div class="related-product-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3>Sản phẩm khác</h3>
                        </div>
                    </div>
                </div>
                <div class="row product-active-lg-4">
                    @foreach ($allPro as $item)
                        <div class="col-lg-12">
                            <!-- single-product-area start -->
                            <div class="single-product-area mt-30">
                                <div class="product-thumb">
                                    <a href="{{route('clien.productDetail',$item->id)}}">
                                        <img class="primary-image" src="{{ asset('uploads') }}/{{ $item->image }}" alt="">
                                    </a>
                                    <div class="action-links">
                                        <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm giỏ hàng"><i class="icon-basket-loaded"></i></a>
                                        <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn" title="Thêm yêu thích"><i class="icon-heart"></i></a>
                                    
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                    <div class="price-box">
                                        <span class="new-price">{{ number_format($pro->sale_price) }}đ</span>
                                        <span class="old-price">{{ number_format($pro->sale_price) }}đ</span>
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
    <!-- main-content-wrap end -->
@endsection