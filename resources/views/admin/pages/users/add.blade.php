@extends('admin.master')
@section('title', 'Add User')
@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm mới nhân viên</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên nhân viên <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('name') }}" name="name"
                                            placeholder="Nhập tên nhân viên" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="email-input" class=" form-control-label">Email nhân viên <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="email" id="email-input" value="{{ old('email') }}" name="email"
                                            placeholder="Nhập email" class="form-control">

                                        @error('email')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="password-input" class=" form-control-label">Mật khẩu <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="password" id="password-input" name="password" placeholder="Password"
                                            class="form-control">

                                        @error('password')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh đại diện <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="avartar" onchange="previewImage(event)"
                                            class="form-control-file">
                                        <img id="preview-image" src="{{ asset('admin/images/noimage.png') }}"
                                            style="width:100px ; height:auto" alt="Preview Image" />
                                        @error('avartar')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Giới tính <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="sex" value="0"
                                                        class="form-check-input" {{ old('key') == 0 ? 'checked' : ':' }}>Nam
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="sex" value="1"
                                                        class="form-check-input" {{ old('key') == 1 ? 'checked' : ':' }}>Nữ
                                                </label>
                                            </div>
                                        </div>
                                        @error('sex')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ngày sinh <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" id="text-input" value="{{ old('birthday') }}" name="birthday"
                                            class="form-control">
                                        @error('birthday')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Địa chỉ <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('address') }}"
                                            name="address" placeholder="Nhập địa chỉ nhân viên" class="form-control">
                                        @error('address')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Lương nhân viên <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" value="{{ old('salary') }}"
                                            name="salary" placeholder="Nhập lương nhân viên" class="form-control">
                                        @error('salary')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Vị trí làm việc <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('position') }}"
                                            name="position" placeholder="Nhập vị trí làm việc nhân viên"
                                            class="form-control">
                                        @error('position')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ngày vào công ty <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" id="text-input" value="{{ old('dateJoinCompany') }}"
                                            name="dateJoinCompany" class="form-control">
                                        @error('dateJoinCompany')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Quyền truy cập <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select  name="role" id="select" class="form-control"> 
                                            <option>Mời chọn</option>
                                            @foreach ($role as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
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
