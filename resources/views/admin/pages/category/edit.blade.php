@extends('admin.master')
@section('title', 'Edit Category')
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

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cập nhật danh mục</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('category.update',$cate->id) }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên danh mục</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ $cate->name }}" name="name"
                                            placeholder="Nhập tên danh mục" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Trạng thái</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="status" value="1"
                                                        class="form-check-input" {{$cate->status==1?'checked':''}}>Hiện
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio" class="form-check-label ">
                                                    <input type="radio" id="radio" name="status" value="0"
                                                        class="form-check-input" {{$cate->status==0?'checked':''}}>Ẩn
                                                </label>
                                            </div>
                                        </div>
                                        @error('status')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Danh mục cha</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select  name="parent_id" id="select" class="form-control"> 
                                            @if ($cate->parent_id == 0)
                                                <option value="0">Không có danh mục cha</option>
                                            @else
                                                <option value="0">Không có danh mục cha</option>
                                                @foreach ($parentCate as $item)
                                                    <option value="{{ $item->id }}" {{ $cate->parentCategory->id==$item->id?'selected':'' }}>{{ $item->name }}</option>
                                                @endforeach  
                                            @endif       
                                                   
                                        </select>
                                        @error('parent_id')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" value="add" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Cập nhật
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Làm mới
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
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
