<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UpdateProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

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
    $brands = DB::Table('brands')->get();
    return view('home', compact('brands'));
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
    return view('admin.index', compact('users'));
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/user/logout',[BrandController::class, 'userLogout'])->name('user.logout');

//Change password
Route::get('/user/change-password',[UpdateProfileController::class, 'changePassword'])->name('change.password');
Route::post('/user/update-password',[UpdateProfileController::class, 'updatePassword'])->name('update.password');

// update profile
Route::get('/user/profile-update', [UpdateProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('/user/user-profile-update', [UpdateProfileController::class, 'updateUserProfile'])->name('update.userProfile');
