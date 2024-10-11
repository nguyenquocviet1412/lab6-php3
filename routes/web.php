<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login, register, logout

Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin'])->name('postLogin');

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister'])->name('postRegister');

Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/user/edit/{user}', [AuthController::class,'userEdit'])->name('user.edit');
Route::post('/user/edit/{user}', [AuthController::class,'userUpdate'])->name('user.update');

Route::get('/user/matkhau/{user}', [AuthController::class,'userMatKhau'])->name('user.matkhau');
Route::post('/user/matkhau/{user}', [AuthController::class,'userMK'])->name('user.MK');

Route::get('/admin/list', [AuthController::class,'listUsers'])->name('admin.list');

Route::post('/admin/toggle-status/{user}', [AuthController::class, 'toggleStatus'])->name('admin.toggleStatus');
