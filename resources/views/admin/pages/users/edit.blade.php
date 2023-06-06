@extends('admin.master')
@section('title','Edit User')
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
                        <strong>Chỉnh sửa nhân viên</strong>
                    </div>
                    <div class="card-body card-block">
                        <form method="POST" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tên nhân viên<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ $user->name }}" name="name"
                                        placeholder="Nhập tên nhân viên" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email-input" class=" form-control-label">Email nhân viên<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" id="email-input" value="{{ $user->email }}" name="email" placeholder="Nhập email"
                                        class="form-control">

                                        @error('email')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="password-input"  class=" form-control-label">Mật khẩu</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" value="{{ $user->password }}"  id="password-input" name="password" placeholder="Password"
                                        class="form-control" readonly>

                                        @error('password')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">Ảnh đại diện cũ</label>
                                </div>
                                <div class="col-12 col-md-9"> 
                                    <img src="{{ asset('uploads') }}\{{ $user->avartar }}"
                                        width="100px" alt="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="file-input" class=" form-control-label">Ảnh đại diện</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" value="{{ $user->avartar }}" name="avartar" class="form-control-file">
                                    <img id="preview-image" src="{{ asset('admin/images/noimage.png') }}"
                                            style="width:100px ; height:auto" alt="Preview Image" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Giới tính<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check">
                                        <div class="radio">
                                            <label for="radio1" class="form-check-label ">
                                                <input type="radio" id="radio1" {{ $user->sex==0?'checked':'' }} name="sex" value="0"
                                                    class="form-check-input">Nam
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="radio1" class="form-check-label ">
                                                <input type="radio" id="radio1" {{ $user->sex==1?'checked':'' }} name="sex" value="1"
                                                    class="form-check-input">Nữ
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
                                    <label for="text-input"  class=" form-control-label">Ngày sinh<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="text-input" value="{{  $user->birthday }}" name="birthday" class="form-control">
                                    @error('birthday')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Địa chỉ<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" value="{{ $user->address }}" id="text-input" name="address"
                                        placeholder="Nhập địa chỉ nhân viên" class="form-control">
                                        @error('address')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Lương nhân viên<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" value="{{ $user->salary }}" id="text-input" name="salary"
                                        placeholder="Nhập lương nhân viên" class="form-control">
                                        @error('salary')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Vị trí làm việc<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{ $user->position }}" name="position"
                                        placeholder="Nhập vị trí làm việc nhân viên" class="form-control">
                                        @error('position')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Ngày vào công ty<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" id="text-input" value="{{ $user->dateJoinCompany }}" name="dateJoinCompany"
                                        class="form-control">
                                        @error('dateJoinCompany')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="select" class=" form-control-label">Quyền truy cập<span class="required" style="color: red">*</span></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select  name="role" id="select" class="form-control"> 
                                        <option>Mời chọn</option>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}" {{ $role_old_id == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
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