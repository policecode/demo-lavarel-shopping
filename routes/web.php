<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\client\HomeClientController;
use App\Http\Controllers\client\DetailController;
use App\Http\Controllers\client\ShopController;
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
Route::post('/dang-ky-nhan-tin',[HomeClientController::class, 'signUpFor'])->name('dang-ky-nhan-tin');
// Trang cửa hàng
Route::get('/shop',[ShopController::class, 'getShopping'])->name('shopping');

// Trang chi tiết sản phẩm
Route::prefix('san-pham')->name('san-pham')->group(function(){
    Route::get('/{id}',[DetailController::class, 'detailProduct'])->name('.detail');
    Route::post('/comment',[DetailController::class, 'commentProduct'])->name('.comment');
});

require __DIR__.'/auth.php';

// auth:doctor Nếu chưa đăng nhập thì không thể vào trong này
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [HomeController::class, 'getHome'])->name('home');

    Route::prefix('/categories')->name('categories')->group(function(){
        Route::get('/', [CategoriesController::class, 'getCategory'])->name('');
        Route::get('/add', [CategoriesController::class, 'getFormAdd'])->name('.add');
        Route::post('/create', [CategoriesController::class, 'createCategory'])->name('.create');
        Route::get('/{id}/update', [CategoriesController::class, 'getFormUpdate'])->name('.formUpdate');
        Route::put('/update', [CategoriesController::class, 'updateCategory'])->name('.update');
        Route::get('/{id}/delete', [CategoriesController::class, 'deleteCategory'])->name('.sortDelete');
    });

    Route::prefix('/menu')->name('menu')->group(function(){
        Route::get('/', [MenuController::class, 'getMenu'])->name('');
        Route::get('/add', [MenuController::class, 'getFormAdd'])->name('.add');
        Route::post('/create', [MenuController::class, 'createMenu'])->name('.create');
        Route::get('/{id}/update', [MenuController::class, 'getFormUpdate'])->name('.formUpdate');
        Route::put('/update', [MenuController::class, 'updateCategory'])->name('.update');
        Route::get('/{id}/delete', [MenuController::class, 'deleteMenu'])->name('.sortDelete');
    });

    Route::prefix('/product')->name('product')->group(function(){
        Route::get('/', [ProductController::class, 'getProduct'])->name('.list');
        Route::get('/add', [ProductController::class, 'getFormAdd'])->name('.add');
        Route::post('/add', [ProductController::class, 'createProduct']);
        Route::get('/{id}/update', [ProductController::class, 'getFormUpdate'])->name('.formUpdate');
        Route::put('/update', [ProductController::class, 'updateProduct'])->name('.update');
        Route::delete('/delete', [ProductController::class, 'deleteProduct'])->name('.sortDelete');
    });

    Route::prefix('/slider')->name('slider')->group(function(){
        Route::get('/', [SliderController::class, 'getSlider'])->name('.list');
        Route::get('/add', [SliderController::class, 'getFormAdd'])->name('.add');
        Route::post('/add', [SliderController::class, 'createSlider']);
        Route::get('/{id}/update', [SliderController::class, 'getFormUpdate'])->name('.formUpdate');
        Route::put('/update', [SliderController::class, 'updateSlider'])->name('.update');
        Route::delete('/delete', [SliderController::class, 'deleteSlider'])->name('.sortDelete');
    });

    Route::prefix('/settings')->name('settings')->group(function(){
        Route::get('/', [SettingController::class, 'getHomeSettings'])->name('.home');
        Route::prefix('/update')->name('.update')->group(function(){
            Route::get('/home', [SettingController::class, 'getFormUpdateHome'])->name('.home');
            Route::put('/home', [SettingController::class, 'updateHomePage']);
        });
    });
});