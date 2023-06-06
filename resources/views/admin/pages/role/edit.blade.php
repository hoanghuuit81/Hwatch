@extends('admin.master');
@section('title', 'Edit Role');
@section('main')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Chi tiết quyền</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('role.update', $role->id) }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên quyền</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ $role->name }}" name="name"
                                            placeholder="Nhập tên vai trò" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Mô tả</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="password-input" name="description" placeholder="Mô tả" class="form-control">{{ $role->description }}</textarea>

                                        @error('description')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col col-md-3">
                                        <br>
                                        <strong>Vai trò này có quyền gì?</strong>
                                    </div>
                                </div>
                                @foreach ($per as $perName => $pers)
                                    <div class="card my-4 border">
                                        <div class="card-header">
                                            <input type="checkbox" class="check-all" name="" id="product">
                                            <label for="product" class="m-0">Module {{ ucfirst($perName) }}</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($pers as $item)
                                                    <div class="col-md-3">
                                                        <input type="checkbox" class="permission"
                                                            value="{{ $item->id }}" name="permission_id[]"
                                                            id="{{ $item->slug }}" {{ in_array($item->id, $checked) ? 'checked' : '' }}>
                                                        <label for="{{ $item->slug }}">{{ $item->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
