@extends('admin.master')
@section('title', 'Add banner')
@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm mới banner</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('banner.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tiêu đề <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('title') }}" name="title"
                                            placeholder="Nhập tiêu đề banner" class="form-control">
                                        @error('title')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('name') }}" name="name"
                                            placeholder="Nhập tên banner" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh banner <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="image" onchange="previewImage(event)"
                                            class="form-control-file">
                                        <img id="preview-image" src="{{ asset('admin/images/noimage.png') }}"
                                            style="width:150px ; height:auto" alt="Preview Image" />
                                        @error('image')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input"  class=" form-control-label">Mô tả <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea   id="password-input" name="description" placeholder="Mô tả"
                                            class="form-control">{{ old('description') }}</textarea>
    
                                            @error('description')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Giá <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" value="{{ old('price') }}" name="price"
                                            placeholder="Nhập giá sản phẩm" class="form-control">
                                        @error('price')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Trạng thái <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="status" value="1"
                                                        class="form-check-input" checked>Hiện
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio" class="form-check-label ">
                                                    <input type="radio" id="radio" name="status" value="0"
                                                        class="form-check-input" >Ẩn
                                                </label>
                                            </div>
                                        </div>
                                        @error('status')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <small class="form-text text-muted pb-2">Những trường có dấu(<span class="required" style="color: red">*</span>) không được để trống</small>
                                    <br>
                                <button type="submit" value="add" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Thêm
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
