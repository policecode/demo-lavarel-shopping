<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\client\HomeClientController;
use App\Http\Controllers\client\DetailController;
use App\Http\Controllers\client\ShopController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\PayController;
// Gửi mail
// use App\Mail\SendMail;
// use Illuminate\Support\Facades\Mail;

use Faker\Factory;

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
// Trang chủ
Route::get('/',[HomeClientController::class, 'index'])->name('home');
// Route::get('/',function () {
//     $mailable= new SendMail();
//     Mail::to('dat01655993202@gmail.com')->send($mailable);
//     dd(true);
// })->name('home');

Route::post('/dang-ky-nhan-tin',[HomeClientController::class, 'signUpFor'])->name('dang-ky-nhan-tin');
// Trang cửa hàng
Route::get('/shop',[ShopController::class, 'getShopping'])->name('shopping');
// Trang chi tiết sản phẩm
Route::prefix('san-pham')->name('san-pham')->group(function(){
    Route::get('/{id}',[DetailController::class, 'detailProduct'])->name('.detail');
    Route::post('/comment',[DetailController::class, 'commentProduct'])->name('.comment');
});
// Giỏ hàng: Cart
Route::prefix('cart')->name('cart')->group(function(){
    Route::get('/', [CartController::class, 'getFormCart'])->name('.home');
    Route::post('/add-product',[CartController::class, 'addProduct'])->name('.add-product');
    Route::put('/update-product/{index}',[CartController::class, 'updateProduct'])->name('.update-product');
    
    // API
    Route::get('/add-product/{id}',[CartController::class, 'addProductToCart'])->name('.add-cart');
    Route::get('/getApiOrderCart', [CartController::class, 'getBildCart'])->name('.apiOrderCart');
    Route::get('/delete-product/{index}', [CartController::class, 'deleteProduct'])->name('.delete');
});
// Thanh toán
Route::prefix('pay')->name('pay')->group(function () {
    Route::get('/form-customer', [PayController::class, 'viewFormcustomer'])->name('.form-customer');
    Route::post('/form-customer', [PayController::class, 'productPayment']);
});
require __DIR__.'/auth.php';

// auth:doctor Nếu chưa đăng nhập thì không thể vào trong này
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [HomeController::class, 'getHome'])->name('home');

    Route::prefix('/categories')->name('categories')->middleware('can:categories.view')->group(function(){
        Route::get('/', [CategoriesController::class, 'getCategory'])->name('');
        Route::get('/add', [CategoriesController::class, 'getFormAdd'])->name('.add')->middleware('can:categories.create');
        Route::post('/create', [CategoriesController::class, 'createCategory'])->name('.create')->middleware('can:categories.create');
        Route::get('/{id}/update', [CategoriesController::class, 'getFormUpdate'])->name('.formUpdate')->middleware('can:categories.edit');
        Route::put('/update', [CategoriesController::class, 'updateCategory'])->name('.update')->middleware('can:categories.edit');
        Route::get('/{id}/delete', [CategoriesController::class, 'deleteCategory'])->name('.sortDelete')->middleware('can:categories.delete');
    });

    Route::prefix('/users')->name('users.')->middleware('can:users.view')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('/add', [UserController::class, 'add'])->name('add')->middleware('can:users.create');

    });

    Route::prefix('/groups')->name('groups.')->middleware('can:groups.view')->group(function(){
        Route::get('/', [GroupController::class, 'index'])->name('index');

        Route::get('/add', [GroupController::class, 'add'])->name('add')->middleware('can:groups.create');
        Route::post('/add', [GroupController::class, 'create'])->middleware('can:groups.create');

        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('edit')->middleware('can:groups.edit');
        Route::post('/edit/{group}', [GroupController::class, 'update'])->middleware('can:groups.edit');

        Route::get('/delete/{group}', [GroupController::class, 'delete'])->name('delete')->middleware('can:groups.delete');

        Route::get('/permission/{group}', [GroupController::class, 'permission'])->name('permission')->middleware('can:groups.permission');
        Route::post('/permission/{group}', [GroupController::class, 'updatePermission'])->middleware('can:groups.permission');
    });

    Route::prefix('/menu')->name('menu')->middleware('can:menus.view')->group(function(){
        Route::get('/', [MenuController::class, 'getMenu']);
        Route::get('/add', [MenuController::class, 'getFormAdd'])->name('.add')->middleware('can:menus.create');
        Route::post('/create', [MenuController::class, 'createMenu'])->name('.create')->middleware('can:menus.create');
        Route::get('/{id}/update', [MenuController::class, 'getFormUpdate'])->name('.formUpdate')->middleware('can:menus.edit');
        Route::put('/update', [MenuController::class, 'updateCategory'])->name('.update')->middleware('can:menus.edit');
        Route::get('/{id}/delete', [MenuController::class, 'deleteMenu'])->name('.sortDelete')->middleware('can:menus.delete');
    });

    Route::prefix('/product')->name('product')->middleware('can:product.view')->group(function(){
        Route::get('/', [ProductController::class, 'getProduct'])->name('.list');
        Route::get('/add', [ProductController::class, 'getFormAdd'])->name('.add')->middleware('can:product.create');
        Route::post('/add', [ProductController::class, 'createProduct'])->middleware('can:product.create');
        Route::get('/{id}/update', [ProductController::class, 'getFormUpdate'])->name('.formUpdate')->middleware('can:product.edit');
        Route::put('/update', [ProductController::class, 'updateProduct'])->name('.update')->middleware('can:product.edit');
        Route::delete('/delete', [ProductController::class, 'deleteProduct'])->name('.sortDelete')->middleware('can:product.delete');
    });

    Route::prefix('/slider')->name('slider')->middleware('can:slider.view')->group(function(){
        Route::get('/', [SliderController::class, 'getSlider'])->name('.list');
        Route::get('/add', [SliderController::class, 'getFormAdd'])->name('.add')->middleware('can:slider.create');
        Route::post('/add', [SliderController::class, 'createSlider'])->middleware('can:slider.create');
        Route::get('/{id}/update', [SliderController::class, 'getFormUpdate'])->name('.formUpdate')->middleware('can:slider.edit');
        Route::put('/update', [SliderController::class, 'updateSlider'])->name('.update')->middleware('can:slider.edit');
        Route::delete('/delete', [SliderController::class, 'deleteSlider'])->name('.sortDelete')->middleware('can:slider.delete');
    });

    Route::prefix('/settings')->name('settings')->group(function(){
        Route::get('/', [SettingController::class, 'getHomeSettings'])->name('.home');
        Route::prefix('/update')->name('.update')->group(function(){
            Route::get('/home', [SettingController::class, 'getFormUpdateHome'])->name('.home');
            Route::put('/home', [SettingController::class, 'updateHomePage']);
        });
    });
});