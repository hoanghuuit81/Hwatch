<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Detail_image;
use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (!Gate::allows('product.index')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }

        $act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($req->input('status') == 'trash') {
            $act = [
                'forceDelete' => 'Xóa vĩnh viễn',
                'restore' => 'khôi phục'
            ];
            $pro = Products::onlyTrashed()->paginate(5);
        } else {
            $key = '';
            if ($req->input('key')) {
                $key = $req->input('key');
            }
            $pro = Products::where('name', 'LIKE', "%{$key}%")->orderBy('id', 'desc')->paginate(5);
        }
        $count_active = Products::count();
        $count_trash = Products::onlyTrashed()->count();


        return view('admin.pages.product.list', compact('pro', 'count_active', 'count_trash', 'act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('category.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cate = Category::where('parent_id', 0)->where('status',1)->get();


        return view('admin.pages.product.add', compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if (!Gate::allows('product.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:50',
                'price' => 'required',
                'sale_price' => 'lt:price',
                'image' => 'required',
                'status' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'detailImages' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'name' => 'Tên nhân viên',
                'price' => 'Giá gốc',
                'sale_price' => 'Giá khuyến mãi',
                'image' => 'Ảnh sản phẩm',
                'status' => 'Trạng thái',
                'category_id' => 'Danh mục',
                'description' => 'Mô tả',
                'detailImages' => 'Ảnh chi tiết',
            ]
        );


        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        $pro = Products::create([
            'name' => $req->input('name'),
            'price' => $req->input('price'),
            'sale_price' => $req->input('sale_price'),
            'image' => $file_name,
            'status' => $req->input('status'),
            'category_id' => $req->input('category_id'),
            'description' => $req->input('description'),
            'bestSeller' => $req->input('bestSeller'),
        ]);

        if ($req->has('detailImages')) {
            $files = $req->detailImages;
            foreach ($files as $value) {
                $img_pro_name = $value->getClientOriginalName();
                $value->move(public_path('uploads'), $img_pro_name);
                Detail_image::create([
                    'image' => $img_pro_name,
                    'product_id' => $pro->id,
                ]);
            }
        }



        return redirect()->route('product.index')->with('flash', 'Thêm mới sản phẩm thành công');
    }

    public function ckeditorImage(Request $req){
        if($req->hasFile('upload')){
            $name = $req->file('upload')->getClientOriginalName();
            $head = pathinfo($name, PATHINFO_FILENAME);
            $last = $req->file('upload')->getClientOriginalExtension();
            $file_name = $head.'_'.time().'.'.$last;
            $req->file('upload')->move(public_path('uploads/ckeditor'),$file_name);

            $CKEditorFuncNum = $req->input('CKEditorFuncNum');

            $url = asset('uploads/ckeditor/'.$file_name);
            $mess = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$mess')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
            

        }
    }

    public function fileBrowser(){
        $paths = glob(public_path('uploads/ckeditor/*'));
        $file_name = array();
        foreach($paths as $path){
            array_push($file_name,basename($path));
        }

        $data = array(
            'fileNames' => $file_name
        );

        return view('admin.pages.image.file')->with($data);

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
        if (!Gate::allows('product.edit')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $pro = Products::find($id);
        $cate = Category::where('parent_id', 0)->where('status',1)->get();
        $detail_images = $pro->detailImages;
        return view('admin.pages.product.edit', compact('pro', 'cate', 'detail_images'));
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

        if (!Gate::allows('product.edit')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $pro = Products::find($id);
        $req->validate(
            [
                'name' => 'required|max:50',
                'price' => 'required',
                'sale_price' => 'lt:price',
                'status' => 'required',
                'category_id' => 'required',
                'description' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'name' => 'Tên nhân viên',
                'price' => 'Giá gốc',
                'sale_price' => 'Giá khuyến mãi',
                'status' => 'Trạng thái',
                'category_id' => 'Danh mục',
                'description' => 'Mô tả',
            ]
        );

        if (!$req->has('image')) {
            $file_name = $pro->image;
        } else {
            // Xóa file cũ
            $isExists = File::exists(public_path('files/' . $pro->file));

            if ($isExists) {
                File::delete(public_path('files/' . $pro->file));
            }

            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $req->merge(['file_name' => $file_name]);
        }

        $pro->update([
            'name' => $req->input('name'),
            'price' => $req->input('price'),
            'sale_price' => $req->input('sale_price'),
            'image' => $file_name,
            'status' => $req->input('status'),
            'category_id' => $req->input('category_id'),
            'description' => $req->input('description'),
            'bestSeller' => $req->input('bestSeller'),
        ]);

        if (!$req->has('detailImages')) {
            $old_image = $pro->detailImages;
            foreach ($old_image as $item) {
                $item->update([
                    'image' => $item->image,
                    'product_id' => $pro->id,
                ]);
            }
        } else {
            $files = $req->detailImages;
            $old_image = $pro->detailImages;
            foreach ($old_image as $value) {
                $find_multi_image = Detail_image::find($value->id);
                $find_multi_image->delete();
            }
            foreach ($files as $value) {
                $img_pro_name = $value->getClientOriginalName();
                $value->move(public_path('upload'), $img_pro_name);
                Detail_image::create([
                    'image' => $img_pro_name,
                    'product_id' => $pro->id,
                ]);
            }
        }



        return redirect()->route('product.index')->with('flash', 'Cập nhật sản phẩm thành công');
    }

    public function action(Request $req)
    {
        $list_check = $req->input('list_check');


        if (!empty($list_check)) {

            $act = $req->input('act');
            if ($act == 'delete') {
                if (!Gate::allows('product.delete')) {
                    return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Products::destroy($list_check);
                return redirect()->route('product.index')->with('flash', 'Xóa thành công');
            }

            if ($act == 'restore') {
                if (!Gate::allows('product.delete')) {
                    return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Products::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect()->route('product.index')->with('flash', 'Khôi phục thành công');
            }

            if ($act == 'forceDelete') {
                if (!Gate::allows('product.delete')) {
                    return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Products::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('product.index')->with('flash', 'Xóa vĩnh viễn thành công');
            }
        } else {
            return redirect()->route('product.index')->with('flash', 'Bạn cần chọn mục thể thực hiện hành động');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('product.delete')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $pro = Products::find($id);
        $hasOrderDetails = $pro->orderDetails->count();
        if($hasOrderDetails == 0){
            $pro->delete();
            return redirect()->route('product.index')->with('flash', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->route('product.index')->with('warning', 'Không được xóa sản phẩm đã có đơn hàng');
        }
        
    }
}
