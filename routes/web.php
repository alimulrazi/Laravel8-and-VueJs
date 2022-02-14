<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

//category controller
Route::get('/category/all', [CategoryController::class, 'allCategory'])->name('all.category');
Route::post('/category/add',[CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class, 'editCategory']);
Route::post('/category/update/{id}',[CategoryController::class, 'updateCategory']);
Route::get('/category/delete/{id}',[CategoryController::class, 'deleteCategory']);
Route::get('/category/restore/{id}',[CategoryController::class, 'restoreCategory']);
Route::get('/category/permanent-delete/{id}',[CategoryController::class, 'permanentDeleteCategory']);

// brand controller
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}',[BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}',[BrandController::class, 'deleteBrand']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
