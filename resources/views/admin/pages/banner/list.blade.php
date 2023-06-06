@extends('admin.master')
@section('title', 'List banner')
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
                    <h3 class="title-5 m-b-35">Danh sách banner</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form class="form-header" action="#">
                                <input class="au-input au-input--xl" type="text" name="key"
                                    value="{{ request()->input('key') }}" placeholder="Tìm kiếm banner" />
                                <button class="au-btn--submit" type="submit" value="Tìm kiếm">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>


                        </div>

                    </div>
                    
                    
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                

                            </div>

                            <div class="table-data__tool-right">
                                <a href="{{ route('banner.add') }}"
                                    class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                    <i class="zmdi zmdi-plus"></i>Thêm banner</a>

                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        
                                        <th>Stt</th>
                                        <th>Tiêu đề</th>
                                        <th>Tên</th>
                                        <th>Ảnh banner</th>
                                        <th>description</th>
                                        <th>price</th>
                                        <th>status</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $k = 0; ?>
                                    @foreach ($banners as $item)
                                        <tr class="tr-shadow">
                                           
                                            <td>{{ $k+=1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="desc"><img src="{{ asset('uploads') }}\{{ $item->image }}"
                                                width="120px" alt=""></td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ number_format($item->price) }}đ</td>
                                            @if ($item->status == 1)
                                                <td> <span class="badge badge-success">Kích hoạt</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Ẩn</span></td>
                                            @endif
                                            
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('banner.edit', $item->id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Chi tiết">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    
                                                        <a class="item" href="{{ route('banner.delete', $item->id) }}"
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
            {{ $banners->links() }}
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
