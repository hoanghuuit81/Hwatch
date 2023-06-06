<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Category_blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        
        if(! Gate::allows('blog.index')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        
        $act = [
            'delete'=>'Xóa tạm thời'
        ];
        if($req->input('status')=='trash'){
            $act = [
                'forceDelete'=>'Xóa vĩnh viễn',
                'restore'=>'khôi phục'
            ];
            $blogs = Blog::onlyTrashed()->paginate(5);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $blogs = Blog::where('title_blog','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(5);
        }
            $count_active = Blog::count();
            $count_trash = Blog::onlyTrashed()->count();

            
        return view('admin.pages.blog.list',compact('blogs','count_active','count_trash','act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('blog.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cateBlog = Category_blog::all();

        return view('admin.pages.blog.add',compact('cateBlog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if (!Gate::allows('blog.add')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'title_blog' => 'required|max:60',
                'author' => 'required',
                'image' => 'required',
                'content' => 'required',
                'cate_blog_id' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 60 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'title_blog' => 'Tiêu đề bài viết',
                'author' => 'Tác giả',
                'image' => 'Ảnh',
                'content' => 'Nội dung',
                'cate_blog_id' => 'Danh mục bài viết',
                'status' => 'Trạng thái',
            ]
        );


        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        Blog::create([
            'title_blog' => $req->input('title_blog'),
            'author' => $req->input('author'),
            'image' => $file_name,
            'content' => $req->input('content'),
            'cate_blog_id' => $req->input('cate_blog_id'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('blog.index')->with('flash', 'Thêm mới bài viết thành công');
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
        if(! Gate::allows('blog.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $allCate = Category_blog::all();
        $blog = Blog::find($id);
        return view('admin.pages.blog.edit',compact('blog','allCate'));
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
        if (!Gate::allows('blog.edit')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'title_blog' => 'required|max:60',
                'author' => 'required',
                'content' => 'required',
                'cate_blog_id' => 'required',
                'status' => 'required',

            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 60 ký tự',
                'lt' => ':attribute phải nhỏ hơn giá gốc',
            ],
            [
                'title_blog' => 'Tiêu đề bài viết',
                'author' => 'Tác giả',
                'content' => 'Nội dung',
                'cate_blog_id' => 'Danh mục bài viết',
                'status' => 'Trạng thái',
            ]
        );

        $blog = Blog::find($id);


        

        if (!$req->has('image')) {
           $file_name = $blog->image;
        }else{
            $isExists = File::exists(public_path('files/' . $blog->file));

            if ($isExists) {
                File::delete(public_path('files/' . $blog->file));
            }

            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $req->merge(['file_name' => $file_name]);
        }


        $blog->update([
            'title_blog' => $req->input('title_blog'),
            'author' => $req->input('author'),
            'image' => $file_name,
            'content' => $req->input('content'),
            'cate_blog_id' => $req->input('cate_blog_id'),
            'status' => $req->input('status'),
        ]);

        return redirect()->route('blog.index')->with('flash', 'Cập nhật blog thành công');
    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
             
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('blog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Blog::destroy($list_check);
                return redirect()->route('blog.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('blog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Blog::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('blog.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('blog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Blog::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('blog.index')->with('flash','Xóa vĩnh viễn thành công');
            }

        }else{
            return redirect()->route('blog.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
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
        if(! Gate::allows('blog.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blog.index')->with('flash','Xóa thành công');
    }
}
