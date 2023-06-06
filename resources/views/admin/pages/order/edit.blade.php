@extends('admin.master');
@section('title', 'Order detail');
@section('main')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-invoice-header">
                <h3 class="title-5 m-b-35">Chi tiết đơn hàng</h3>
                
            </div>
        </div>
        <form action="{{ route('order.update',$order->id) }}" method="post">
            @csrf
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="js-select2" name="status">
                            @if ( $order->status == 1)
                                <option selected value="1">Chờ lấy hàng</option>
                                <option value="2">Đang giao</option>
                                <option value="3">Đã giao</option> 
                            @elseif($order->status == 2)
                                <option selected value="2">Đang giao</option>
                                <option value="3">Đã giao</option> 
                            @elseif($order->status == 3)
                                <option value="3">Đã giao</option> 
                            @else
                                <option selected value="0">Đang xử lý</option>
                                <option  value="1">Chờ lấy hàng</option>
                                <option value="2">Đang giao</option>
                                <option value="3">Đã giao</option>
                            @endif
                                                  
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="btn-search" value="Cập nhật">

                </div>

            </div>
        </form>
        <div class="row justify-content-center">
            
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="card-table">
                            
                            <div class="card-body">
                              
                                <div class="invoice-item invoice-item-date">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-start invoice-details">
                                                Ngày đặt<span>: </span><strong>{{ date('d-m-Y', strtotime($order->created_at)) }}</strong>
                                            </p>
                                        </div> 
                                        <div class="col-md-6" style="text-align: right">
                                            <p class="invoice-details">
                                                Mã đơn hàng<span>: </span><strong>{{ $order->code_order }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="invoice-item invoice-item-two">
                                    <div  class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text-one">Gửi từ<span>:</span></strong>
                                                <p class="invoice-details-two">
                                                    Hwatch<br>
                                                    My Dinh - Ha Noi <br>
                                                    0899276830<br>
                                                    taisaokhong81@gmail.com
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="text-align: right">
                                            <div class="invoice-info invoice-info2">
                                                <strong class="customer-text-one">Gửi đến<span>:</span></strong>
                                                <p class="invoice-details-two text-end">
                                                    {{ $order->customer->name }}<br>
                                                    {{ $order->address }}<br>
                                                    {{ $order->phone }}<br>
                                                    {{ $order->customer->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="invoice-item invoice-table-wrap">
                                    <div class="invoice-table-head">
                                        <h4>Sản phẩm:</h4>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-center table-hover mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Stt</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Đơn giá</th>
                                                            <th>Số lượng</th>
                                                            
                                                            <th>Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $k=0 ?>
                                                        @foreach ($order->orderDetails as $item)
                                                            <tr>
                                                                <td>{{ $k+=1 }}</td>
                                                                <td>{{ $item->product->name }}</td>
                                                                <td>{{ number_format($item->price) }}VND</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                
                                                                <td>{{ number_format($item->subtotal) }}VND</td>
                                                            </tr>
                                                        @endforeach
                                                        

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="terms-conditions">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="invoice-terms align-center">
                                                <div class="invocie-note">
                                                    <h5>Ghi chú:</h5>
                                                    <p class="mb-0">{{ $order->notes }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-5 col-md-6">
                                            <div class="invoice-total-card">
                                                <div class="invoice-total-box">
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            
                                                            <div class="invoice-total-inner">
                                                                <p>Tổng đơn hàng</p>
                                                                <p>Phí vận chuyển</p>
                                                               
                                                            </div>
                                                            <div class="invoice-total-footer">
                                                                <h4>Tổng cộng</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="invoice-total-inner">
                                                                <p style="text-align: right" >{{ number_format($order->total_amount) }}</p>
                                                                <p style="text-align: right">0 VND</p>
                                                               
                                                            </div>
                                                            <div class="invoice-total-footer">
                                                                <h4 style="text-align: right">{{ number_format($order->total_amount) }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                {{-- <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                
                                    </div>
                
                                    <div class="table-data__tool-right">
                                        <a target="_blank" href="{{ route('order.pdf',$order->id) }}"
                                            class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                            <i class="fa fa-print" aria-hidden="true"></i>In</a>
                                        
                
                                    </div>
                                </div> --}}
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>>
@endsection
