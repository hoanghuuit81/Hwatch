@extends('admin.master');
@section('title','Order');
@section('main')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        @if (session('flash'))
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                <span class="badge badge-pill badge-success">Thông báo</span>
                {{ session('flash') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
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
                <!-- DATA TABLE -->
                <h3 class="title-5 m-b-35">Danh sách đơn hàng</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form class="form-header" action="#">
                            <input class="au-input au-input--xl" type="text" name="key"
                                value="{{ request()->input('key') }}" placeholder="Tìm kiếm mã đơn hàng" />
                            <button class="au-btn--submit" type="submit" value="Tìm kiếm">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>


                    </div>

                </div>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" style="padding-right: 5px; padding-bottom:7px" class="text-primary">Tất cả<span class="text-muted">({{ $countAll }})</span></a> 
                <a href="{{ request()->fullUrlWithQuery(['status' => '0']) }}" style="padding-right: 5px; padding-bottom:7px" class="text-primary">Đang xử lý<span class="text-muted">({{ $count0 }})</span></a> 
                 <a href="{{ request()->fullUrlWithQuery(['status' => '1']) }}" style="padding-right: 5px; padding-bottom:7px" class="text-primary">Chờ lấy hàng<span class="text-muted">({{ $count1 }})</span></a>
                 <a href="{{ request()->fullUrlWithQuery(['status' => '2']) }}" style="padding-right: 5px; padding-bottom:7px" class="text-primary">Đang giao<span class="text-muted">({{ $count2 }})</span></a>
                 <a href="{{ request()->fullUrlWithQuery(['status' => '3']) }}"  class="text-primary">Đã giao<span class="text-muted">({{ $count3 }})</span></a>
                
                    <div class="table-data__tool">
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                   
                                    <th>Stt</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Người đặt</th>
                                    <th>Tổng đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $k = 0; ?>
                                @foreach ($orders as $item)
                                    <tr class="tr-shadow">
                                        <td>{{ $k+=1 }}</td>
                                        <td>{{ $item->code_order }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ number_format($item->total_amount)  }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        @if ($item->status == 0)
                                            <td> <span class="btn btn-danger">Đang xử lý</span></td>
                                        @elseif($item->status == 1)
                                            <td><span class="btn btn-warning">Chờ lấy hàng</span></td>
                                        @elseif($item->status == 2)
                                            <td><span class="btn btn-info">Đang giao</span></td>
                                        @else
                                            <td><span class="btn btn-success">Đã giao</span></td>
                                        @endif
                                        
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('order.edit', $item->id) }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Xem">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                
                                                    <a class="item" href="{{ route('order.delete', $item->id) }}"
                                                        onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này')"
                                                        data-toggle="tooltip" data-placement="top" title="Xóa">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                               

                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                

                <!-- END DATA TABLE -->
            </div>
        </div>
        {{ $orders->links() }}
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2022 Colorlib. All rights reserved. Template by <a
                            href="https://www.facebook.com/huu.hoang.587">Hoang Hai Huu</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection