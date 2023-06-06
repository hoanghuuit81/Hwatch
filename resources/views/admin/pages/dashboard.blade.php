@extends('admin.master')
@section('title', 'Dashboard')

@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('warning'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Cảnh báo</span>
                    {{ session('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Trang chủ</h2>

                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $totalUser }}</h2>
                                    <span>Thành viên</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $totalProduct }}</h2>
                                    <span>Sản phẩm</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $totalOrders }}</h2>
                                    <span>Đơn hàng</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                                <div class="text">
                                    <h4 style="color:rgb(255, 255, 255)">{{ number_format($totalAmount) }}VNĐ </h4>
                                    <span>Doanh thu</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Đơn hàng</h3>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>#</th>                                  
                                    <th>Ngày đặt</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tổng đơn hàng</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $k=0 ?>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $k+=1 }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->code_order }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ number_format($item->total_amount)  }}</td>

                                        @if ($item->status == 0)
                                            <td style="color: #fa4251" > Đang xử lý</td>
                                        @elseif($item->status == 1)
                                            <td style="color: #ffc107" >Chờ lấy hàng</td>
                                        @elseif($item->status == 2)
                                            <td style="color: #17a2b8" >Đang giao</td>
                                        @else
                                            <td style="color: #00ad5f" >Đã giao</td>
                                        @endif
                                        
                                    </tr>   
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2023 Colorlib. All rights reserved. Template by <a
                                        href="https://www.facebook.com/huu.hoang.587">Hoang Hai Huu</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
