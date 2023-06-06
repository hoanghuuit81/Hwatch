@extends('admin.master')
@section('title', 'Edit Comment')
@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Chi tiết bình luận</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('cmt.update', $comment->id) }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Người bình luận</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="name" value="{{ $comment->name }}" readonly 
                                             class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="email" value="{{ $comment->email }}" readonly 
                                             class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ $comment->product->name }}" readonly 
                                             class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <img src="{{ asset('uploads') }}\{{ $comment->product->image }}" width="100px" alt="">
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
                                                        class="form-check-input" {{ $comment->status == 1 ? 'checked' : '' }}>Hiện
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio" class="form-check-label ">
                                                    <input type="radio" id="radio" name="status" value="0"
                                                        class="form-check-input" {{ $comment->status == 0 ? 'checked' : '' }}>Ẩn
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nội dung</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="description" name="content" readonly class="form-control">{{ $comment->content }}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ngày bình luận</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input"  value="{{ $comment->created_at }}" readonly 
                                             class="form-control">
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
                        <p>Copyright © 2022 Colorlib. All rights reserved. Template by <a
                                href="https://www.facebook.com/huu.hoang.587">Hoang Hai Huu</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
