        <!-- footer Start -->
        <footer>
            <div class="footer-top section-pb section-pt-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">

                            <div class="widget-footer mt-40">
                                <h6 class="title-widget">Liên hệ: </h6>

                                <div class="footer-addres">
                                    <div class="widget-content mb--20">
                                        <p>Địa chỉ: My Dinh, Ha No, <br> Viet Nam</p>
                                        <p>Số điện thoại: <a href="tel:">0899276830</a></p>
                                        <p>Fax: <a href="tel:">08012002</a></p>
                                        <p>Email: <a href="tel:">hoanghuulopb@gmail.com</a></p>
                                    </div>
                                </div>

                                <ul class="social-icons">
                                    <li>
                                        <a class="facebook social-icon" href="#" title="Facebook"
                                            target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a class="twitter social-icon" href="#" title="Twitter" target="_blank"><i
                                                class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a class="instagram social-icon" href="#" title="Instagram"
                                            target="_blank"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a class="linkedin social-icon" href="#" title="Linkedin"
                                            target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a class="rss social-icon" href="#" title="Rss" target="_blank"><i
                                                class="fa fa-rss"></i></a>
                                    </li>
                                </ul>

                            </div>

                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="widget-footer mt-40">
                                <h6 class="title-widget">Thông tin</h6>
                                <ul class="footer-list">
                                    <li><a href="{{ route('clien.index') }}">Trang chủ</a></li>
                                    <li><a href="{{ route('clien.shop') }}">Sản phẩm</a></li>
                                    <li><a href="{{ route('clien.blog') }}">Tin tức</a></li>                
                                    <li><a href="about-us.html">Về chúng tôi</a></li>
                                    <li><a href="contact.html">Liên hệ nhanh</a></li>
                                    

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="widget-footer mt-40">
                                <h6 class="title-widget">Bổ sung</h6>
                                <ul class="footer-list">

                                    <li><a href="{{ route('clien.account') }}">Tài khoản</a></li>
                                    <li><a href="{{ route('clien.favoriteIndex') }}">Yêu thích</a></li>
                                    <li><a href="{{ route('clien.cart') }}">Giỏ hàng</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="widget-footer mt-40">
                                <h6 class="title-widget">Tải ứng dụng</h6>
                                <p>Ứng dụng Hwatch hiện không có có trên Google Play & App Store.</p>
                                <ul class="footer-list">
                                    <li><img src="{{ asset('clien/assets/images/brand/img-googleplay.jpg') }}"
                                            alt=""></li>
                                    <li><img src="{{ asset('clien/assets/images/brand/img-appstore.jpg') }}"
                                            alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="copy-left-text">
                                <p>Copyright &copy; <a href="https://www.facebook.com/huu.hoang.587">Hoang Hai Huu</a>
                                    2023. All Right Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="copy-right-image">
                                <img src="{{ asset('clien/assets/images/icon/img-payment.png') }}" alt="">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer End -->




        <!-- Modal -->
        <div class="modal fade modal-wrapper" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area">
                            <div class="row gx-3 product-details-inner">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                    <!-- Product Details Left -->
                                    <div class="product-large-slider">
                                        <div class="pro-large-img">
                                            <img src="{{ asset('clien/assets/images/product/product-01.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-large-img">
                                            <img src="{{ asset('clien/assets/images/product/product-02.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-large-img ">
                                            <img src="{{ asset('clien/assets/images/product/product-03.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-large-img">
                                            <img src="{{ asset('clien/assets/images/product/product-04.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-large-img">
                                            <img src="{{ asset('clien/assets/images/product/product-05.png') }}"
                                                alt="product-details" />
                                        </div>

                                    </div>
                                    <div class="product-nav">
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('clien/assets/images/product/product-01.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('clien/assets/images/product/product-02.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('clien/assets/images/product/product-03.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('clien/assets/images/product/product-04.png') }}"
                                                alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{ asset('clien/assets/images/product/product-05.png') }}"
                                                alt="product-details" />
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content">
                                        <div class="product-info">
                                            <h3>Single product One</h3>
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
                                                <span class="new-price">$70.00</span>
                                                <span class="old-price">$78.00</span>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla
                                                augue nec est tristique auctor.</p>

                                            <div class="single-add-to-cart">
                                                <form action="#" class="cart-quantity d-flex">
                                                    <div class="quantity">
                                                        <div class="cart-plus-minus">
                                                            <input type="number" class="input-text" name="quantity"
                                                                value="1" title="Qty">
                                                        </div>
                                                    </div>
                                                    <button class="add-to-cart" type="submit">Thêm vào giỏ
                                                        hàng</button>
                                                </form>
                                            </div>
                                            <ul class="single-add-actions">
                                                <li class="add-to-wishlist">
                                                    <a href="wishlist.html" class="add_to_wishlist"><i
                                                            class="icon-heart"></i> Thêm vào yêu thích</a>
                                                </li>
                                            </ul>
                                            <ul class="stock-cont">
                                                <li class="product-stock-status">Danh mục:
                                                    <a href="#">Man Watch</a>
                                                </li>

                                            </ul>
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

        <!-- JS
============================================ -->

        <!-- Modernizer JS -->
        <script src="{{ asset('clien/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>

        <!-- jquery -->
        <script src="{{ asset('clien/assets/js/vendor/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/vendor/jquery-migrate-3.4.0.min.js') }}"></script>

        <!-- Bootstrap JS -->
        <script src="{{ asset('clien/assets/js/vendor/bootstrap.min.js') }}"></script>

        <!-- Plugins JS -->
        <script src="{{ asset('clien/assets/js/plugins/slick.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/countdown.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/image-zoom.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/fancybox.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/scrollup.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/jqueryui.min.js') }}"></script>
        <script src="{{ asset('clien/assets/js/plugins/ajax-contact.js') }}"></script>

        <!-- Sweet alert JS -->
        <script src="{{ asset('clien/assets/package/dist/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('clien/assets/package/dist/sweetalert2.min.js') }}"></script>

        <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->

        {{-- <script src="{{ asset('clien/assets/js/vendor/vendor.min.js')}}"></script>
        <script src="{{ asset('clien/assets/js/plugins/plugins.min.js')}}"></script> --}}


        <!-- Main JS -->
        <script src="{{ asset('clien/assets/js/main.js') }}"></script>

        <script>
            $('.search-ajax').hide();
            $('.input-search-ajax').keyup(function() {
                var _text = $(this).val();
                if (_text != '') {
                    $.ajax({
                        url: "{{ route('clien.search') }}?key= " + _text,
                        type: 'GET',
                        success: function(res) {
                            var _html = '';
                            var count = 0;
                            for (var pro of res) {
                                _html +=
                                    '<div class="card" style="max-width: 500px; height:80px; border:none !important; border-radius:0 !important">';
                                _html += '<div class="row g-0">';
                                _html += ' <div class="col-md-2">';
                                _html +=
                                    ' <img src="{{ asset('uploads') }}/' + pro.image +
                                    ' " style="width:80%; margin-left:10px">';
                                _html += '</div>';
                                _html += '<div class="col-md-10">';
                                _html += '<div class="card-body" style="height: 50px">';
                                _html += '<h6 class="card-title"><a href="#">' + pro.name + '</a> </h6>';
                                _html += '<p class="card-text"><small class="text-muted">Giá: ' + pro
                                    .sale_price + 'đ</small></p>';
                                _html += '</div>';
                                _html += '</div>';
                                _html += '</div>';
                                _html += '</div>';

                                count++;

                                if (count == 5) {
                                    break;
                                }
                            }
                            $('.search-ajax').show(500);


                            $('.search-ajax').html(_html);
                        }
                    })
                } else {
                    $('.search-ajax').html('');
                    $('.search-ajax').hide();
                }



            })
        </script>
        <script>
            $(document).ready(function() {
                $('#sort').on('change', function() {
                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                })
            })
        </script>
        <script>
            $('.quick-view').click(function() {
                var product_id = $(this).data('product_id');
                var _token = $('input[name="_token"]').val();
                $ajax({

                })
            })
        </script>

        @if (session('addFavorite'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Đã thêm vào yêu thích!',
                    showConfirmButton: false,
                    timer: 2500
                })
            </script>
        @endif
        @if (session('addCart'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm vào giỏ hàng thành công!',
                    showConfirmButton: false,
                    timer: 2500
                })
            </script>
        @endif
        @if (session('thanks'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Cảm ơn bạn đã góp ý!',gl
                    showConfirmButton: false,
                    timer: 2500
                })
            </script>
        @endif

        <script>
            function confirmation(ev) {
                ev.preventDefault();

                var url = ev.currentTarget.getAttribute('href');

                console.log(url);

                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    text: "Hành động sẽ được thực thi nếu bạn nhấn đồng ý!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý!'
                }).then((result) => {
                    if (result.isConfirmed) {                        
                        window.location.href = url;       
                    }

                    
                })
            }
        </script>







        </body>


        <!-- Mirrored from htmldemo.net/ruiz/ruiz/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Apr 2023 14:58:58 GMT -->

        </html>
