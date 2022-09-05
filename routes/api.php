<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\DetailController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\PayController;

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',[HomeController::class, 'index']);
// Trang cửa hàng
Route::get('/shop',[ShopController::class, 'index']);
// Trang chi tiết sản phẩm
Route::prefix('san-pham')->group(function(){
    Route::get('/{id}',[DetailController::class, 'detailProduct']);
    Route::post('/comment',[DetailController::class, 'commentProduct']);
});
// // Giỏ hàng: Cart
Route::prefix('cart')->group(function(){
    Route::get('/', [CartController::class, 'index']);
    Route::post('/',[CartController::class, 'add']);

    // Route::put('/update-product/{index}',[CartController::class, 'updateProduct']);
    
    // // API
    // Route::get('/add-product/{id}',[CartController::class, 'addProductToCart']);
    // Route::get('/getApiOrderCart', [CartController::class, 'getBildCart']);
    // Route::get('/delete-product/{index}', [CartController::class, 'deleteProduct']);
});
// Thanh toán
Route::prefix('pay')->name('pay')->group(function () {
    // Route::get('/form-customer', [PayController::class, 'viewFormcustomer']);
    Route::post('/', [PayController::class, 'getPay']);
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'create']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/visit', [LoginController::class, 'visit'])->middleware('auth:sanctum');

    Route::get('/delete', [LoginController::class, 'deleteToken'])->middleware('auth:sanctum');
});