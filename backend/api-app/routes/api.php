<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// routes/api.php

use Illuminate\Support\Facades\Route;

Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/albums/{id}', [AlbumController::class, 'show']);
Route::post('/albums', [AlbumController::class, 'store']);
Route::put('/albums/{id}', [AlbumController::class, 'update']);
Route::delete('/albums/{id}', [AlbumController::class, 'destroy']);
Route::post('/albums/{id}/photos', [AlbumController::class, 'storePhoto']);
Route::delete('/albums/{albumId}/photos/{photoId}', [AlbumController::class, 'destroyPhoto']);
Route::get('/albums/{id}/photos', [AlbumController::class, 'showPhotos']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
