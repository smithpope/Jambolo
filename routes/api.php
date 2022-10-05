<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Middleware;

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

//Register endpoint
route::POST('/register', [RegisterController::class, 'register']);

//Login endpoint
route::POST('/login', [LoginController::class, 'login']);

//image enpoint
route::POST('upload', [ArtisanController::class, 'upload']);

//protected endpoints
route::group(['middleware' => ['auth:sanctum']],function()
{
//artisan endpoint for addArtisan, listArtisan, searchArtisan, updateArtisan, 
//deleteArtisan
route::GET('artisans',[ArtisanController::class, 'index']);
route::GET('searchartisan/{id}', [ArtisanController::class, 'show']);
route::POST('artisans', [ArtisanController::class, 'store']);
route::PUT('artisans/{id}', [ArtisanController::class, 'update']);
route::DELETE ('artisans/{id}', [ArtisanController::class, 'destroy']);

//product endpoint for addProduct, listProduct, searchProduct, updateProduct, 
//deleteProduct
route::GET('products',[ProductController::class, 'index']);
route::GET('searchproduct/{id}', [ProductController::class, 'show']);
route::POST('products', [ProductController::class, 'store']);
route::PUT('products/{id}', [ProductController::class, 'update']);
route::DELETE ('products/{id}', [ProductController::class, 'destroy']);

//user endpoint for listUser, searchUser, updateUser, 
//deleteUser and suspendUser
route::GET('users',[RegisterController::class, 'index']);
route::GET('users/{id}', [RegisterController::class, 'show']);
route::PUT('users/{id}', [RegisteredController::class, 'update']);
route::DELETE ('users/{id}', [RegisteredController::class, 'destroy']);
});