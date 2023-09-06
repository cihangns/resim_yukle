<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\HomeController;

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


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/',[HomeController::class, 'resim_yukle'])->name('resim_yukle');
Route::get('/',[HomeController::class, 'vericek'])->name('resim_yukle');

Route::get("/setprofilepage", [HomeController::class, "setProfilePage"])->name("setprofilepage");
Route::get("/imageslist", [HomeController::class, "imagePage"])->name("imagesList");