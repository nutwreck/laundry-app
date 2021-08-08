<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiController;
use App\Http\Controllers\ProductController;

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

/*
|--------------------------------------------------------------------------
| API login | register | logout | data token
|--------------------------------------------------------------------------
|
|
*/
Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::get('logout', [ApiController::class, 'logout']);
Route::get('get-data-token', [ApiController::class, 'get_user']);

/*
|--------------------------------------------------------------------------
| API Products
|--------------------------------------------------------------------------
|
*/
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/create', [ProductController::class, 'store']);
    Route::put('/update/{product}',  [ProductController::class, 'update']);
    Route::delete('/delete/{product}',  [ProductController::class, 'destroy']);
});
