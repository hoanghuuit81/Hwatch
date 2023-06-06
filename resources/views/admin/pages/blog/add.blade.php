@extends('admin.master')
@section('title', 'Add Blog')
@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm mới bài viết</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tiêu đề bài viết <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ old('title_blog') }}" name="title_blog"
                                            placeholder="Nhập tiêu đề bài viết" class="form-control">
                                        @error('title_blog')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tác giả <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ auth()->user()->name }}" name="author"
                                            placeholder="Nhập tiêu đề bài viết" class="form-control">
                                        @error('author')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh bài viết <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="image" onchange="previewImage(event)"
                                            class="form-control-file">
                                        <img id="preview-image" src="{{ asset('admin/images/noimage.png') }}"
                                            style="width:100px ; height:auto" alt="Preview Image" />
                                        @error('image')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Mô tả <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="ckeditorBlog" name="content" placeholder="Mô tả" class="form-control">{{ old('content') }}</textarea>

                                        @error('content')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Danh mục <span class="required" style="color: red">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="cate_blog_id" id="select" class="form-control">
                                            <option >Mời chọn...</option>
                                            @foreach ($cateBlog as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cate_blog_id')
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
                                                        class="form-check-input">Ẩn
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
