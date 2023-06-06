@extends('clien.master')
@section('title', 'About')
@section('main')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Về chúng tôi</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Page Conttent -->
    <main class="about-us-page section-ptb">

        <div class="about-us_area section-pb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-us_img">
                            <img src="{{ asset('clien/assets/images/banner/about-us_bg.jpg') }}" alt="About Us Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-us_content">
                            <h3 class="heading mb-20">Về Hwatch</h3>
                            <p class="short-desc mb-20">
                                Hwatch - Nơi để tìm kiếm và mua sắm đồng hồ chất lượng. Khám phá bộ sưu tập đa dạng với các
                                mẫu đồng hồ đẹp và phong cách từ các thương hiệu danh tiếng. Trải nghiệm mua sắm trực tuyến
                                dễ dàng và tin cậy với giao diện trực quan, thông tin sản phẩm chi tiết và chính sách mua
                                hàng an toàn. Tạo phong cách riêng của bạn với Hwatch - không gian đồng hồ tuyệt vời.
                            </p>
                            <div class="munoz-btn-ps_left slide-btn">
                                <a class="btn" href="{{ route('clien.shop') }}">Mua sắm ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonials-area bg-gray section-ptb">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class=" testimonials-area">
                            <div class="row testimonial-two">
                                <div class="col-lg-6 m-auto">
                                    <div class="testimonial-wrap-two text-center">
                                        <div class="quote-container">
                                            <div class="quote-image">
                                                <img src="{{ asset('clien/assets/images/testimonial/avt1.JPG') }}"
                                                    alt="">
                                            </div>
                                            <div class="author">
                                                <h6>Hoàng Hải Hữu</h6>
                                                <p>CEO Hwatch</p>
                                            </div>
                                            <div class="testimonials-text">
                                                <p>Hoàng Hải Hữu, CEO của Hwatch, là một nhà lãnh đạo tài ba và đam mê với
                                                    ngành công nghiệp đồng hồ. Với tầm nhìn sáng tạo và kinh nghiệm chiến
                                                    lược, ông đã đưa Hwatch trở thành một thương hiệu đồng hồ nổi tiếng và
                                                    được tin tưởng.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-auto">
                                    <div class="testimonial-wrap-two text-center">
                                        <div class="quote-container">
                                            <div class="quote-image">
                                                <img src="{{ asset('clien/assets/images/testimonial/avt2.JPG') }}"
                                                    alt="">
                                            </div>
                                            <div class="author">
                                                <h6>Hoàng Hữu Hải</h6>
                                                <p>Giám đốc Hwatch</p>
                                            </div>
                                            <div class="testimonials-text">
                                                <p>Hoàng Hữu Hải, giám đốc của Hwatch, là một nhà điều hành xuất sắc với
                                                    kiến thức sâu sắc về thị trường đồng hồ. Dẫn dắt đội ngũ và xây dựng
                                                    chiến lược kinh doanh hiệu quả, ông đã đưa Hwatch trở thành một trong
                                                    những địa chỉ mua sắm đồng hồ hàng đầu.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-auto">
                                    <div class="testimonial-wrap-two text-center">
                                        <div class="quote-container">
                                            <div class="quote-image">
                                                <img src="{{ asset('clien/assets/images/testimonial/testimonial-01.jpg') }}"
                                                    alt="">
                                            </div>
                                            <div class="author">
                                                <h6>Hữu Hải Hoàng</h6>
                                                <p>Phó giám độc Hwatch</p>
                                            </div>
                                            <div class="testimonials-text">
                                                <p>Hữu Hải Hoàng, Phó giám đốc điều hành của Hwatch, là một người có sự đam
                                                    mê và tận hưởng trong công việc. Với khả năng lãnh đạo xuất sắc và tinh
                                                    thần sáng tạo, ông đóng vai trò quan trọng trong việc định hình chiến
                                                    lược kinh doanh và đảm bảo sự phát triển bền vững của Hwatch.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->
@endsection
