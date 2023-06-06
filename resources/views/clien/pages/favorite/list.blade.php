@extends('clien.master')
@section('title', 'Favorite')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Trang yêu thích</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    @if ($favorites->count() == 0)
         <!-- main-content-wrap start -->
         <div class="main-content-wrap section-ptb wishlist-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="search-error-wrapper">
                            <h2>Không có sản phẩm yêu thích</h2>
                            <p class="home-link">Hãy quay lại trang chủ hoặc trang sản phẩm!!</p>
                            <a href="{{ route('clien.index') }}" class="home-bacck-button">Về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-content-wrap end -->
    @else
         <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" class="cart-table">
                        <div class=" table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="plantmore-product-thumbnail">Ảnh</th>
                                        <th class="cart-product-name">Sản phẩm</th>
                                        <th class="plantmore-product-price">Giá</th>
                                        <th class="plantmore-product-stock-status">Trạng thái</th>
                                        <th class="plantmore-product-add-cart">Thêm vào giỏ hàng</th>
                                        <th class="plantmore-product-remove">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        @foreach ($favorites as $item)
                                            <tr>
                                                <td class="plantmore-product-thumbnail"><a style="max-width:40%"
                                                        href="{{ route('clien.productDetail', $item->product->id) }}"><img
                                                            src="{{ asset('uploads') }}/{{ $item->product->image }}"
                                                            alt=""></a></td>
                                                <td class="plantmore-product-name"><a
                                                        href="{{ route('clien.productDetail', $item->product->id) }}">{{ $item->product->name }}</a>
                                                </td>
                                                <td class="plantmore-product-price"><span
                                                        class="amount">{{ number_format($item->product->sale_price) }}
                                                        đ</span></td>
                                                @if ($item->product->status == 1)
                                                    <td class="plantmore-product-stock-status"><span class="in-stock">Còn
                                                            hàng</span></td>
                                                @else
                                                    <td class="plantmore-product-stock-status"><span class="out-stock">Hết
                                                            hàng</span></td>
                                                @endif

                                                <td class="plantmore-product-add-cart"><a href="{{ route('clien.addCart',$item->product->id) }}">Thêm vào giỏ
                                                        hàng</a></td>
                                                <td class="plantmore-product-remove"><a
                                                        href="{{ route('clien.delFavorite', $item->id) }}"
                                                        onclick="confirmation(event)"><i class="fa fa-times"></i></a></td>
                                            </tr>
                                        @endforeach


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                {{$favorites->links('clien.pages.paginate.pagination')}}
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
    @endif
   
@endsection
