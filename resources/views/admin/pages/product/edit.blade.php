@extends('admin.master')
@section('title', 'Edit Product')
@section('main')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Chi tiết sản phẩm</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="POST" action="{{ route('product.update', $pro->id) }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Tên sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" value="{{ $pro->name }}" name="name"
                                            placeholder="Nhập tên sản phẩm" class="form-control">
                                        @error('name')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Giá sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" value="{{ $pro->price }}" name="price"
                                            placeholder="Nhập giá sản phẩm" class="form-control">
                                        @error('price')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Giá khuyến mãi</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" value="{{ $pro->sale_price }}"
                                            name="sale_price" placeholder="Nhập giá khuyến mãi" class="form-control">
                                        @error('sale_price')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">Ảnh sản phẩm</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="image" onchange="previewImage(event)"
                                            class="form-control-file">
                                        <img src="{{ asset('uploads') }}\{{ $pro->image }}" width="100px" alt="">
                                        @error('image')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="detailImages" class=" form-control-label">Ảnh chi tiết</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" name="detailImages[]" class="form-control-file"
                                            id="detailImages" multiple>
                                        <div id="preview"
                                            style="width: 100px;
                                        height: 100px;
                                        object-fit: cover;
                                        display:flex;
                                        margin-right: 10px;
                                        margin-bottom: 10px;">
                                            @foreach ($detail_images as $item)
                                                <img src="{{ asset('uploads') }}\{{ $item->image }}" style="width:100px"
                                                    alt="">
                                            @endforeach
                                        </div>

                                        @error('detailImages')
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
                                                        class="form-check-input" {{ $pro->status == 1 ? 'checked' : '' }}>Hiện
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio" class="form-check-label ">
                                                    <input type="radio" id="radio" name="status" value="0"
                                                        class="form-check-input" {{ $pro->status == 0 ? 'checked' : '' }}>Ẩn
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
                                        <label for="select" class=" form-control-label">Danh mục</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="category_id" id="select" class="form-control">
                                            @foreach ($cate as $item)
                                                <option disabled>{{ $item->name }}</option>
                                                @if ($item->children)
                                                    @foreach ($item->children as $value)
                                                        @if ($value->status == 1)
                                                            <option value="{{ $value->id }}"  {{ $pro->category_id == $value->id ? 'selected' : '' }}>|----{{ $value->name }}
                                                        </option>
                                                        @endif  
                                                    @endforeach
                                                @endif
                                            @endforeach

                                        </select>
                                        @error('category_id')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Hiển thị bán chạy</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio2" class="form-check-label ">
                                                    <input type="radio" id="radio2" name="bestSeller"
                                                        value="1" class="form-check-input"
                                                        {{ $pro->bestSeller == 1 ? 'checked' : '' }}>Có
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio3" class="form-check-label ">
                                                    <input type="radio" id="radio3" name="bestSeller"
                                                        value="0" class="form-check-input"
                                                        {{ $pro->bestSeller == 0 ? 'checked' : '' }}>Không
                                                </label>
                                            </div>
                                        </div>
                                        @error('bestSeller')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Mô tả</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea id="ckeditorProduct" name="description" placeholder="Mô tả" class="form-control">{{ $pro->description }}</textarea>

                                        @error('description')
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
