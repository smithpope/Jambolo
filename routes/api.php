<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::GET('artisans',[ArtisanController::class, 'index']);
route::GET('searchartisan/{id}', [ArtisanController::class, 'show']);
route::POST('artisans', [ArtisanController::class, 'store']);
route::POST('upload', [ArtisanController::class, 'upload']);
route::PUT('artisans/{id}', [ArtisanController::class, 'update']);
route::DELETE ('artisans/{id}', [ArtisanController::class, 'destroy']);

route::GET('products',[ProductController::class, 'index']);
route::GET('searchproduct/{id}', [ProductController::class, 'show']);
route::POST('products', [ProductController::class, 'store']);
//route::POST('upload', [ProductController::class, 'upload']);
route::PUT('products/{id}', [ProductController::class, 'update']);
route::DELETE ('products/{id}', [ProductController::class, 'destroy']);
