@extends('admin.master')
@section('title', 'List Comment')
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
                    <h3 class="title-5 m-b-35">Danh sách comment</h3>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Link sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Nội dung</th>
                                        <th>Ngày bình luận</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $k = 0; ?>
                                    @foreach ($comments as $item)
                                        <tr class="tr-shadow">
                                            <td>{{ $k+=1 }}</td>
                                            <td><a href="{{route('clien.productDetail',$item->product->id)}}" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Link</a></td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="desc"><img src="{{ asset('uploads') }}\{{ $item->product->image }}"
                                                width="50px" alt=""></td>
                                            <td>{!! Str::limit($item->content, 30, ' ...')   !!}</td>
                                            <td>{{ $item->created_at }}</td>
                                            @if ($item->status == 1)
                                            <td> <span class="badge badge-success">Hiện</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Ẩn</span></td>
                                            @endif
                                           
                                            
                                            
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('cmt.edit', $item->id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Chi tiết">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                 
                                                        <a class="item" href="{{ route('cmt.delete', $item->id) }}"
                                                            onclick="return confirm('Bạn có chắc muốn xóa mục này?')"
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
            {{ $comments->links() }}
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
