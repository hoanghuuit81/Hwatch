@extends('clien.master')
@section('title', 'Shop')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
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
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <!-- shop-sidebar-wrap start -->
                    <div class="shop-sidebar-wrap">
                        <div class="shop-box-area">

                            <!--sidebar-categores-box start  -->
                            <div class="sidebar-categores-box shop-sidebar mb-30">
                                <h4 class="title">Danh mục</h4>
                                <!-- category-sub-menu start -->
                                <div class="category-sub-menu">
                                    <ul>
                                        @foreach ($parentCate as $item)
                                            <li class="has-sub"><a href="#">{{ $item->name }}</a>
                                                <ul>
                                                    @foreach ($item->children as $value)
                                                        @if ($value->status == 1)
                                                            <li><a href="{{route('clien.proByCate',$value->id)}}">{{ $value->name }}({{ $value->products->count() }})</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                <!-- category-sub-menu end -->
                            </div>
                            <!--sidebar-categores-box end  -->

                            <!-- shop-sidebar start -->
                            <div class="shop-sidebar mb-30">
                                <h4 class="title">Lọc theo giá</h4>
                                <!-- filter-price-content start -->
                                <div class="filter-price-content">
                                    <form action="{{ route('clien.sortByPrice') }}" method="post">
                                        @csrf
                                        <div id="price-slider" class="price-slider"></div>
                                        <div class="filter-price-wapper">

                                            <button type="submit" class="add-to-cart-button">
                                                <span>Lọc</span>
                                            </button>
                                            <div class="filter-price-cont">

                                                <span>Giá:</span>
                                                <div class="input-type">
                                                    <input type="text" id="min-price" name="min-price" style="width:60px" readonly="" />
                                                </div>
                                                <span>—</span>
                                                <div class="input-type">
                                                    <input type="text" id="max-price" name="max-price" style="width: 70px;" readonly="" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- filter-price-content end -->
                            </div>
                            <!-- shop-sidebar end -->


                        </div>
                    </div>
                    <!-- shop-sidebar-wrap end -->
                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <!-- shop-product-wrapper start -->
                    <div class="shop-product-wrapper">
                        <div class="row align-itmes-center">
                            <div class="col">
                                <!-- shop-top-bar start -->
                                <div class="shop-top-bar">
                                    <!-- product-view-mode start -->

                                    <div class="product-mode">
                                        <!--shop-item-filter-list-->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active"><a class="active grid-view" data-bs-toggle="tab"
                                                    href="#grid"><i class="fa fa-th"></i></a></li>
                                            <li><a class="list-view" data-bs-toggle="tab" href="#list"><i
                                                        class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <!-- product-view-mode end -->
                                    <!-- product-short start -->
                                    <form>
                                        @csrf
                                        <div class="product-short">
                                            <p>Lọc theo :</p>
                                            <select class="nice-select" name="sort" id="sort">
                                                <option value="{{Request::url()}}?sort_by=none" >Mời chọn</option>
                                                <option value="{{Request::url()}}?sort_by=nameAz">Tên(A - Z)</option>
                                                <option value="{{Request::url()}}?sort_by=nameZa">Tên(Z - A)</option>
                                                <option value="{{Request::url()}}?sort_by=priceAz">Giá(Low > High)</option>
                                                <option value="{{Request::url()}}?sort_by=priceZa">Giá(High > Low)</option>
                                            </select>
                                        </div>
                                    </form>
                                    
                                    <!-- product-short end -->
                                </div>
                                <!-- shop-top-bar end -->
                            </div>
                        </div>

                        <!-- shop-products-wrap start -->
                        <div class="shop-products-wrap">
                            <div class="tab-content">
                                <div class="tab-pane active" id="grid">
                                    <div class="shop-product-wrap">
                                        <div class="row">
                                            @foreach ($allPro as $item)
                                            <div class="col-lg-4 col-md-6">
                                                <!-- single-product-area start -->
                                                <div class="single-product-area mt-30">
                                                    <div class="product-thumb">
                                                        <a href="{{route('clien.productDetail',$item->id)}}">
                                                            <img class="primary-image"
                                                                src="{{ asset('uploads') }}/{{ $item->image }}" alt="">
                                                        </a>
                                                        <div class="action-links">
                                                            <a href="{{ route('clien.addCart',$item->id) }}" class="cart-btn" title="Thêm vào giỏ hàng"><i
                                                                    class="icon-basket-loaded"></i></a>
                                                            <a href="{{ route('clien.addFavorite',$item->id) }}" class="wishlist-btn"
                                                                title="Thêm vào yêu thích"><i class="icon-heart"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="product-caption">
                                                        <h4 class="product-name"><a href="{{route('clien.productDetail',$item->id)}}">{{ $item->name }}</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price">{{ number_format($item->sale_price) }}</span>
                                                            <span class="old-price">{{ number_format($item->price) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single-product-area end -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="list">
                                    <div class="shop-product-list-wrap">
                                        @foreach ($allPro as $item)
                                        <div class="row product-layout-list mt-30">
                                            <div class="col-lg-3 col-md-3">
                                                <!-- single-product-wrap start -->
                                                <div class="single-product">
                                                    <div class="product-image">
                                                        <a href="product-details.html"><img
                                                                src="{{ asset('uploads') }}/{{ $item->image }}"
                                                                alt="Produce Images"></a>
                                                    </div>
                                                </div>
                                                <!-- single-product-wrap end -->
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="product-content-list text-left">

                                                    <h4><a href="product-details.html" class="product-name">{{ $item->name }}</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">{{ number_format($item->sale_price) }}</span>
                                                            <span class="old-price">{{ number_format($item->price) }}</span>
                                                    </div>

                                                    {{-- <div class="product-rating">
                                                        <ul class="d-flex">
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                                            <li class="bad-reting"><a href="#"><i
                                                                        class="icon-star"></i></a></li>
                                                        </ul>
                                                    </div> --}}

                                                    <div>{!! htmlspecialchars_decode($item->description) !!}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3">
                                                <div class="block2">
                                                    <ul class="stock-cont">
                                                        <ul class="stock-cont">
                                                            <li class="product-stock-status">Danh mục: <span class="in-stock">{{ $item->category->name }}</span></li>
                                                        </ul>
                                                    </ul>
                                                    <div class="product-button">

                                                        <ul class="actions">
                                                            <li class="add-to-wishlist">
                                                                <a href="{{ route('clien.addFavorite',$item->id) }}" class="add_to_wishlist"><i
                                                                        class="icon-heart"></i> Yêu thícht</a>
                                                            </li>
                                                        </ul>
                                                        <div class="add-to-cart">
                                                            <div class="product-button-action">
                                                                <a href="{{ route('clien.addCart',$item->id) }}" class="add-to-cart">Thêm vào giỏ hàng</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop-products-wrap end -->

                        <!-- paginatoin-area start -->
                        {{$allPro->links('clien.pages.paginate.pagination')}}
                        <!-- paginatoin-area end -->
                    </div>
                    <!-- shop-product-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->

@endsection
