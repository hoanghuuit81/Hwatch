@extends('admin.master')
@section('title', 'List Category Blog')
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
                    <h3 class="title-5 m-b-35">Danh mục bài viết</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <form class="form-header" action="#">
                                <input class="au-input au-input--xl" type="text" name="key"
                                    value="{{ request()->input('key') }}" placeholder="Tìm kiếm danh mục bài viết" />
                                <button class="au-btn--submit" type="submit" value="Tìm kiếm">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>


                        </div>

                    </div>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}"
                        style="padding-right: 5px; padding-bottom:7px" class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count_active }})</span></a> 
                     <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary"> Vô hiệu
                    hóa<span class="text-muted">({{ $count_trash }})</span></a>
                    <form action="{{ route('cateBlog.action') }}" method="post">
                        @csrf
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="act">
                                        <option selected="selected">Chọn tác vụ</option>
                                        @foreach ($act as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <input class="btn btn-primary" type="submit" name="btn-search" value="Áp dụng">

                            </div>

                            <div class="table-data__tool-right">
                                <a href="{{ route('cateBlog.add') }}"
                                    class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                    <i class="zmdi zmdi-plus"></i>Thêm danh mục</a>

                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="au-checkbox">
                                                <input type="checkbox" name="check-all" onclick="checkAll()">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </th>
                                        <th>Stt</th>
                                        <th>Tên danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $k = 0; ?>
                                    @foreach ($cate as $item)
                                        <tr class="tr-shadow">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox" name="list_check[]" value="{{ $item->id }}">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{ $k+=1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            @if ($item->status == 1)
                                            <td> <span class="badge badge-success">Bật</span></td>
                                            @else
                                                <td><span class="badge badge-danger">Ẩn</span></td>
                                            @endif
                                            <td>{{date('d-m-Y', strtotime($item->created_at))  }}</td>
                                            
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ route('cateBlog.edit', $item->id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Chi tiết">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    @if ($item->deleted_at == null)
                                                        <a class="item" href="{{ route('cateBlog.delete', $item->id) }}"
                                                            onclick="return confirm('Bạn có chắc muốn xóa mục này')"
                                                            data-toggle="tooltip" data-placement="top" title="Xóa">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- END DATA TABLE -->
                </div>
            </div>
            {{-- {{ $role->links() }} --}}
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
