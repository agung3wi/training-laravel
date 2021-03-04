<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vendor/src', [VendorController::class, 'search']);

// Route::middleware(['auth.rest'])->group(function () {

Route::get('/vendor', [VendorController::class, 'index']);
Route::post('/vendor/create', [VendorController::class, 'create']);
Route::put('/vendor/update/{id}', [VendorController::class, 'update']);
Route::delete('/vendor/delete/{id}', [VendorController::class, 'delete']);
// });


Route::post('/upload', [UploadController::class, 'upload']);

Route::post(
    '/login',
    [AuthController::class, 'login']
);
Route::get("/login", function () {
    return "Login";
})->name("login");

Route::middleware(['auth.rest'])->group(function () {

    Route::get(
        '/check',
        [AuthController::class, 'check']
    );
});

Route::post(
    '/register',
    [AuthController::class, 'register']
);

Route::post(
    '/logout',
    [AuthController::class, 'logout']
);
