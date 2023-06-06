@extends('clien.master')
@section('title', 'Blog')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bài viết</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- main-content-wrap start -->
    <div class="main-content-wrap blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    <!-- blog-sidebar-wrap start -->
                    <div class="blog-sidebar-wrap section-pt">
                        <div class="blog-sidebar-widget-area">

                            <!--single-widget start  -->
                            <div class="single-widget search-widget mb-30">
                                <h4 class="widget-title">Tìm kiếm bài viết</h4>
                                <form action="#">
                                    <div class="form-input">
                                        <input type="text" name="key" placeholder="Tìm bài viết ">
                                        <button class="button-search" type="submit"><i class="icon-magnifier"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!--single-widget start end -->

                            <!--single-widget start  -->
                            <div class="single-widget mb-30">
                                <h4 class="widget-title">Danh mục</h4>
                                <!-- category-widget start -->
                                <div class="category-widget-list">
                                    <ul>
                                        @foreach ($cateBlogs as $item)
                                            <li><a href="{{ route('clien.blogByCate',$item->id) }}">{{ $item->name }}</a></li>
                                        @endforeach
                                       
                                    </ul>
                                </div>
                                <!-- category-widget end -->
                            </div>
                            <!--single-widget end  -->

                            <!--single-widget start  -->
                            <div class="single-widget mb-30">
                                <h4 class="widget-title">Bài viết gần đây</h4>

                                <div class="recent-post-widget">
                                    @foreach ($recentPosts as $item)
                                        <div class="single-widget-post">
                                            <div class="post-thumb">
                                                <a href="{{ route('clien.blogDetail',$item->id) }}"><img src="{{ asset('uploads') }}/{{ $item->image }}" alt=""></a>
                                            </div>
                                            <div class="post-info">
                                                <h6 class="post-title"><a href="{{ route('clien.blogDetail',$item->id) }}">{{ $item->title_blog }}</a></h6>
                                                <div class="post-date">{{ date('d-m-Y', strtotime($item->created_at)) }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <!--single-widget end  -->

                        </div>
                    </div>
                    <!-- blog-sidebar-wrap end -->
                </div>
                <div class="col-lg-9 order-lg-2 order-1">

                    <div class="blog-wrapper section-pt">
                        <div class="row">
                            @foreach ($blogs as $item)
                                <div class="col-lg-6 col-md-6">
                                    <div class="singel-latest-blog">
                                        <div class="articles-image">
                                            <a href="{{ route('clien.blogDetail',$item->id) }}">
                                                <img src="{{ asset('uploads') }}/{{ $item->image }}" alt="">
                                            </a>
                                        </div>
                                        <div class="aritcles-content">
                                            <div class="author-name">
                                                Đăng bởi: <a href="#"> {{ $item->author }}</a> - {{ date('d-m-Y', strtotime($item->created_at)) }}
                                            </div>
                                            <h4><a href="{{ route('clien.blogDetail',$item->id) }}" class="articles-name">{{ $item->title_blog }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            

                        </div>

                        <!-- paginatoin-area start -->
                        {{$blogs->links('clien.pages.paginate.pagination')}}
                        <!-- paginatoin-area end -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection