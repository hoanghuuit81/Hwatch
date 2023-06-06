<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\dashboard;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\admin\permissionController;
use App\Http\Controllers\admin\roleController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\bannerController;
use App\Http\Controllers\admin\categoryBlogController;
use App\Http\Controllers\admin\blogController;
use App\Http\Controllers\admin\orderController;
use App\Http\Controllers\clien\homeController;
use App\Http\Controllers\clien\customerController;
use App\Http\Controllers\clien\shopController;
use App\Http\Controllers\clien\postController;
use App\Http\Controllers\clien\commentController;
use App\Http\Controllers\clien\favoriteController;
use App\Http\Controllers\clien\cartController;
use App\Http\Controllers\clien\aboutController;
use App\Http\Controllers\clien\contactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


//Admin route

Route::middleware('auth')->group(function () {

    Route::get('/admin', [dashboard::class, 'index'])->name('dashboard');
    // Route::get('/admin/login', function () {
    //     return view('auth.login');
    // })->name('login');
    Route::get('/admin/logout', [dashboard::class, 'logout'])->name('logout');

    //route module users
    Route::get('/admin/user', [userController::class, 'index'])->name('user.index');
    Route::get('/admin/user/add', [userController::class, 'create'])->name('user.add');
    Route::post('/admin/user/store', [userController::class, 'store'])->name('user.store');
    Route::get('/admin/user/edit/{id}', [userController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user/update/{id}', [userController::class, 'update'])->name('user.update');
    Route::get('/admin/user/delete/{id}', [userController::class, 'destroy'])->name('user.delete');
    Route::post('/admin/user/action', [userController::class, 'action'])->name('user.action');

    //route module permissions
    Route::get('/admin/permission', [permissionController::class, 'index'])->name('permission.index');
    Route::get('/admin/permission/add', [permissionController::class, 'create'])->name('permission.add');
    Route::post('/admin/permission/store', [permissionController::class, 'store'])->name('permission.store');
    Route::get('/admin/permission/edit/{id}', [permissionController::class, 'edit'])->name('permission.edit');
    Route::post('/admin/permission/update/{id}', [permissionController::class, 'update'])->name('permission.update');
    Route::get('/admin/permission/delete/{id}', [permissionController::class, 'destroy'])->name('permission.delete');
    Route::post('/admin/permission/action', [permissionController::class, 'action'])->name('permission.action');

    //route module roles
    Route::get('/admin/role', [roleController::class, 'index'])->name('role.index');
    Route::get('/admin/role/add', [roleController::class, 'create'])->name('role.add');
    Route::post('/admin/role/store', [roleController::class, 'store'])->name('role.store');
    Route::get('/admin/role/edit/{id}', [roleController::class, 'edit'])->name('role.edit');
    Route::post('/admin/role/update/{id}', [roleController::class, 'update'])->name('role.update');
    Route::get('/admin/role/delete/{id}', [roleController::class, 'destroy'])->name('role.delete');
    Route::post('/admin/role/action', [roleController::class, 'action'])->name('role.action');

    //route module category
    Route::get('/admin/category', [categoryController::class, 'index'])->name('category.index');
    Route::get('/admin/category/add', [categoryController::class, 'create'])->name('category.add');
    Route::post('/admin/category/store', [categoryController::class, 'store'])->name('category.store');
    Route::get('/admin/category/edit/{id}', [categoryController::class, 'edit'])->name('category.edit');
    Route::post('/admin/category/update/{id}', [categoryController::class, 'update'])->name('category.update');
    Route::get('/admin/category/delete/{id}', [categoryController::class, 'destroy'])->name('category.delete');
    Route::post('/admin/category/action', [categoryController::class, 'action'])->name('category.action');

    //route module products
    Route::get('/admin/product', [productController::class, 'index'])->name('product.index');
    Route::get('/admin/product/add', [productController::class, 'create'])->name('product.add');
    Route::post('/admin/product/store', [productController::class, 'store'])->name('product.store');
    Route::get('/admin/product/edit/{id}', [productController::class, 'edit'])->name('product.edit');
    Route::post('/admin/product/update/{id}', [productController::class, 'update'])->name('product.update');
    Route::get('/admin/product/delete/{id}', [productController::class, 'destroy'])->name('product.delete');
    Route::post('/admin/product/action', [productController::class, 'action'])->name('product.action');
    Route::post('/admin/product/upload-ckeditor', [productController::class, 'ckeditorImage']);
    Route::get('/admin/product/upload-browser', [productController::class, 'fileBrowser']);

    //route module banner
    Route::get('/admin/banner', [bannerController::class, 'index'])->name('banner.index');
    Route::get('/admin/banner/add', [bannerController::class, 'create'])->name('banner.add');
    Route::post('/admin/banner/store', [bannerController::class, 'store'])->name('banner.store');
    Route::get('/admin/banner/edit/{id}', [bannerController::class, 'edit'])->name('banner.edit');
    Route::post('/admin/banner/update/{id}', [bannerController::class, 'update'])->name('banner.update');
    Route::get('/admin/banner/delete/{id}', [bannerController::class, 'destroy'])->name('banner.delete');

    
    //route module category blogs
    Route::get('/admin/category-blog', [categoryBlogController::class, 'index'])->name('cateBlog.index');
    Route::get('/admin/category-blog/add', [categoryBlogController::class, 'create'])->name('cateBlog.add');
    Route::post('/admin/category-blog/store', [categoryBlogController::class, 'store'])->name('cateBlog.store');
    Route::get('/admin/category-blog/edit/{id}', [categoryBlogController::class, 'edit'])->name('cateBlog.edit');
    Route::post('/admin/category-blog/update/{id}', [categoryBlogController::class, 'update'])->name('cateBlog.update');
    Route::get('/admin/category-blog/delete/{id}', [categoryBlogController::class, 'destroy'])->name('cateBlog.delete');
    Route::post('/admin/category-blog/action', [categoryBlogController::class, 'action'])->name('cateBlog.action');

    //route module category blogs
    Route::get('/admin/blog', [blogController::class, 'index'])->name('blog.index');
    Route::get('/admin/blog/add', [blogController::class, 'create'])->name('blog.add');
    Route::post('/admin/blog/store', [blogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/edit/{id}', [blogController::class, 'edit'])->name('blog.edit');
    Route::post('/admin/blog/update/{id}', [blogController::class, 'update'])->name('blog.update');
    Route::get('/admin/blog/delete/{id}', [blogController::class, 'destroy'])->name('blog.delete');
    Route::post('/admin/blog/action', [blogController::class, 'action'])->name('blog.action');
    Route::post('/admin/blog/upload-ckeditor', [blogController::class, 'ckeditorImage']);
    Route::get('/admin/blog/upload-browser', [blogController::class, 'fileBrowser']);

    //route module customer
    Route::get('/admin/customer', [customerController::class, 'index'])->name('cus.index');
    Route::get('/admin/customer/delete/{id}', [customerController::class, 'destroy'])->name('cus.delete');


    //route module comment
    Route::get('/admin/comment', [commentController::class, 'index'])->name('cmt.index');
    Route::get('/admin/comment/edit/{id}', [commentController::class, 'edit'])->name('cmt.edit');
    Route::post('/admin/comment/update/{id}', [commentController::class, 'update'])->name('cmt.update');
    Route::get('/admin/comment/delete/{id}', [commentController::class, 'destroy'])->name('cmt.delete');

    //route module comment
    Route::get('/admin/order', [orderController::class, 'index'])->name('order.index');
    Route::get('/admin/order/edit/{id}', [orderController::class, 'edit'])->name('order.edit');
    Route::post('/admin/order/update/{id}', [orderController::class, 'update'])->name('order.update');
    Route::get('/admin/order/delete/{id}', [orderController::class, 'destroy'])->name('order.delete');
    Route::get('/admin/order/print-pdf/{id}', [orderController::class, 'printPdf'])->name('order.pdf');

});


//clien route
Route::get('/', [homeController::class, 'index'])->name('clien.index');
Route::get('/account', [homeController::class, 'account'])->name('clien.account');
Route::get('/account/form-foget-password', [homeController::class, 'formForgetPass'])->name('clien.formForgetPass');
Route::post('/account/send-mail-forget-password', [homeController::class, 'sendMailForgetPass'])->name('clien.sendMailForgetPass');
Route::get('/account/form-change-password/{id}/{token}', [homeController::class, 'formChangePass'])->name('clien.formChangePass');
Route::post('/account/post-new-password/{id}', [homeController::class, 'postNewPass'])->name('clien.postNewPass');



//customer route
Route::get('/customer/login', [customerController::class, 'login'])->name('clien.login');
Route::get('/customer/register', [customerController::class, 'registerPage'])->name('clien.registerPage');
Route::post('/customer/post-login', [customerController::class, 'postLogin'])->name('clien.postLogin');
Route::post('/customer/update/{id}', [customerController::class, 'update'])->name('clien.cusUpdate');
Route::get('/customer/logout', [customerController::class, 'logout'])->name('clien.logout');
Route::post('/customer/register', [customerController::class, 'register'])->name('clien.register');

//shop route
Route::get('/shop', [shopController::class, 'index'])->name('clien.shop');
Route::get('/shop/detail-product/{id}', [shopController::class, 'productDetail'])->name('clien.productDetail');
Route::post('/shop/product-by-price', [shopController::class, 'sortByPrice'])->name('clien.sortByPrice');
Route::get('/shop/product-by-category/{id}', [shopController::class, 'proByCate'])->name('clien.proByCate');

//comment route
Route::post('/customer/post-comment/{id}', [commentController::class, 'postComment'])->name('clien.postComment');

//blogs route
Route::get('/post', [postController::class, 'index'])->name('clien.blog');
Route::get('/post/post-by-category/{id}', [postController::class, 'postByCate'])->name('clien.blogByCate');
Route::get('/post/detail/{id}', [postController::class, 'blogDetail'])->name('clien.blogDetail');


//favorite route
Route::get('/favorite/add/{id}',[favoriteController::class,'add'])->name('clien.addFavorite')->middleware('cus');
Route::get('/favorite/list',[favoriteController::class,'list'])->name('clien.favoriteIndex')->middleware('cus');
Route::get('/favorite/delete/{id}',[favoriteController::class,'delete'])->name('clien.delFavorite')->middleware('cus');

//cart route
Route::get('/cart', [cartController::class, 'index'])->name('clien.cart')->middleware('cus');
Route::get('/cart/add/{id}', [cartController::class, 'add'])->name('clien.addCart')->middleware('cus');
Route::get('/cart/delete/{id}', [cartController::class, 'delete'])->name('clien.delCart');
Route::post('/cart/update', [cartController::class, 'update'])->name('clien.updateCart');
Route::get('/cart/destroy', [cartController::class, 'destroy'])->name('clien.destroyCart');
Route::get('/cart/check-out', [cartController::class, 'form_checkout'])->name('clien.formCheckOut')->middleware('cus');
Route::post('/cart/post-check-out', [cartController::class, 'postCheckOut'])->name('clien.postCheckOut')->middleware('cus');

//about route
Route::get('/about-us', [aboutController::class, 'index'])->name('clien.about');

//contact route
Route::get('/contact-us', [contactController::class, 'index'])->name('clien.contact');
Route::post('/contact-us/postContact', [contactController::class, 'postContact'])->name('clien.postContact');

