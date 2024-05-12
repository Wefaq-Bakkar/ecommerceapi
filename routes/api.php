<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LocationController;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group(['prefix'=>'brands'],function($router){
    Route::controller(BrandsController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('delete/{id}','delete_brand');
    });
});
Route::group(['prefix'=>'categories'],function($router){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('delete/{id}','delete_category');
    });
});


Route::prefix('locations')->group(function () {
    Route::get('index', [LocationController::class, 'index']);
    Route::get('show/{id}', [LocationController::class, 'show']);
    Route::post('store', [LocationController::class, 'store']);
    Route::put('update/{id}', [LocationController::class, 'update']);
    Route::delete('delete/{id}', [LocationController::class, 'destroy']);
});

Route::group(['prefix'=>'products'],function($router){
    Route::controller(ProductController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('delete/{id}','destroy');
    });
});
Route::group(['prefix'=>'orders'],function($router){
    Route::controller(OrderController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('delete/{id}','destroy');
        Route::get('get_order_products/{id}','get_order_products');
        Route::get('get_user_orders','get_user_orders');
        Route::get('change_order_status/{id}','change_order_status');
    });
});
