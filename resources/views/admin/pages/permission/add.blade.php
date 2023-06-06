@extends('admin.master');
@section('title','Add Permission');
@section('main')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Thêm mới vai trò</strong>
                    </div>
                    <div class="card-body card-block">
                        <form method="POST" action="{{ route('permission.store') }}" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tên vai trò <span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ old('name') }}" name="name"
                                        placeholder="Nhập tên vai trò" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Slug <span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ old('slug') }}" name="slug" placeholder="Nhập slug vd: user.add"
                                        class="form-control">

                                        @error('slug')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input"  class=" form-control-label">Mô tả</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea   id="password-input" name="description" placeholder="Mô tả"
                                        class="form-control">{{ old('description') }}</textarea>

                                        @error('description')
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
                    <p>Copyright © 2022 Colorlib. All rights reserved. Template by <a href="https://www.facebook.com/huu.hoang.587">Hoang Hai Huu</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection