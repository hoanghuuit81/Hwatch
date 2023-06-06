@extends('admin.master')
@section('title','Edit Permission')
@section('main')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            @if (session('flash'))
                <div class="alert alert-success" role="alert">
                    {{ session('flash') }}
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Chỉnh sửa vai trò</strong>
                    </div>
                    <div class="card-body card-block">
                        <form method="POST" action="{{route('permission.update',$per->id)}}" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tên vai trò</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ $per->name }}" name="name"
                                        placeholder="Nhập tên vai trò" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Slug</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ $per->slug }}" name="slug"
                                        placeholder="Nhập slug vd: user.add" class="form-control">
                                        @error('slug')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Mô tả</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea type="text" id="text-input" value="{{ $per->description }}" name="description"
                                        placeholder="Nhập mô tả" class="form-control"></textarea>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" value="add" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Cập nhật
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