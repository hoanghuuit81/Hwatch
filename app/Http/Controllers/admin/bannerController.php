<?php

namespace App\Http\Controllers\admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (!Gate::allows('banner.index')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $key = '';
        if($req->input('key')){
            $key = $req->input('key');
        }
        $banners = Banner::where('title','LIKE',"%{$key}%")->orderBy('id','desc')->paginate(3);

        return view('admin.pages.banner.list',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('banner.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        return view('admin.pages.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if (!Gate::allows('banner.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'title' => 'required|max:100',
                'name' => 'required|max:50',
                'image' => 'required',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'title' => 'Tiêu đề',
                'name' => 'Tên nhân viên',
                'image' => 'Ảnh sản phẩm',
                'description' => 'Mô tả',
                'price' => 'Giá gốc',
                'status' => 'Trạng thái',
            ]
        );

        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        Banner::create([
            'title' => $req->input('title'),
            'name' => $req->input('name'),
            'image' => $file_name,
            'description' => $req->input('description'),
            'price' => $req->input('price'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('banner.index')->with('flash', 'Thêm mới banner thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('banner.edit')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $banner = Banner::find($id);
        return view('admin.pages.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if (!Gate::allows('banner.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'title' => 'required|max:100',
                'name' => 'required|max:50',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'title' => 'Tiêu đề',
                'name' => 'Tên nhân viên',
                'description' => 'Mô tả',
                'price' => 'Giá gốc',
                'status' => 'Trạng thái',
            ]
        );
        $banner = Banner::find($id);

        if (!$req->has('image')) {
           $file_name = $banner->image;
        }else{
            $isExists = File::exists(public_path('files/' . $banner->file));

            if ($isExists) {
                File::delete(public_path('files/' . $banner->file));
            }

            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $req->merge(['file_name' => $file_name]);
        }


        $banner->update([
            'title' => $req->input('title'),
            'name' => $req->input('name'),
            'image' => $file_name,
            'description' => $req->input('description'),
            'price' => $req->input('price'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('banner.index')->with('flash', 'Cập nhật banner thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('banner.index')->with('flash', 'Xóa banner thành công');
    }
}
