<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CommentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('galleries', [GalleriesController::class, 'index']);
Route::post('create', [GalleriesController::class, 'store']);
Route::delete('gallery/{id}', [GalleriesController::class, 'destroy']);
Route::get('gallery/{id}', [GalleriesController::class, 'show']);
Route::get('my-galleries', [GalleriesController::class, 'getMyGalleries']);
Route::get('authors/{id}', [GalleriesController::class, 'getAuthorsGalleries']);

Route::get('gallery/{id}/comments', [CommentsController::class, 'index']);
Route::post('gallery/{id}/comments', [CommentsController::class, 'store']);
Route::delete('gallery/{gId}/comments/{cId}', [CommentsController::class, 'destroy']);

Route::post('add-image', [ImagesController::class, 'store']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});
