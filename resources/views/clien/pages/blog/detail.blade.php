@extends('clien.master')
@section('title', 'Blog Detail')
@section('main')

     <!-- breadcrumb-area start -->
     <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chi tiết bài viết</li>
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
                    <!-- blog-sidebar-wrap start -->
                    <div class="blog-sidebar-wrap">
                        <div class="blog-sidebar-widget-area">

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
                                                <div class="post-date">{{ $item->created_at }}</div>
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

                    <div class="blog-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- single-blog-wrap Start -->
                                <div class="single-blog-wrap mb-40">
                                    <div class="latest-blog-content mt-0">
                                        <h4><a href="blog-details.html">{{ $blog->title_blog }}</a></h4>
                                        <ul class="post-meta">
                                            <li class="post-author">Bởi <a href="#">{{ $blog->author }} </a></li>
                                            <li class="post-date">{{ date('d-m-Y', strtotime($blog->created_at))  }}</li>
                                        </ul>
                                    </div>
                                    <div>{!! htmlspecialchars_decode($blog->content) !!}</div>
                                </div>
                                <!-- single-blog-wrap End -->

                            </div>
                        </div>

                        <div class="related-post-blog-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <h4>Bài viết liên quan</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($recentBlogs as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-latest-blog mt-30">
                                        <div class="latest-blog-image">
                                            <a href="{{ route('clien.blogDetail',$item->id) }}"><img src="{{ asset('uploads') }}/{{ $item->image }}" alt=""></a>
                                        </div>
                                        <div class="latest-blog-content mt-20">
                                            <h4><a href="{{ route('clien.blogDetail',$item->id) }}"> {{ $item->title_blog }}</a></h4>
                                            <ul class="post-meta">
                                                <li class="post-date">{{ date('d-m-Y', strtotime($item->created_at)) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->

@endsection