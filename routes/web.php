<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/login', [AuthController::class, 'loginPage'])->name('admin-login');
Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])->name('admin-dashboard');

// category route
Route::get('/category', [CategoryController::class, 'listCategory'])->name('category');
Route::get('/edit-category/{id}', [CategoryController::class, 'listCategory'])->name('edit.category');
Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('create.category');
// Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
Route::get('/change-category-status/{id}', [CategoryController::class, 'categoryStatus'])->name('category.status');


Route::get('/logout', [AuthController::class, 'logOut']);


// sub category route 
Route::get('/subcategory', [CategoryController::class, 'listSubCategory'])->name('subcategory');
Route::get('/subcategory/{id}', [CategoryController::class, 'listSubCategory'])->name('edit.subcategory');
Route::post('/subcategory', [CategoryController::class, 'createSubcategory'])->name('create.subcategory');
Route::post('/subcategory/{id}', [CategoryController::class, 'updateSubCategory'])->name('update.subcategory');


// Brand Route

Route::get('/brands', [BrandController::class, 'listBrand'])->name('brand');
Route::post('/create-brand', [BrandController::class, 'createBrand'])->name('create.brand');
Route::get('/edit-brand/{id}', [BrandController::class, 'listBrand'])->name('edit.brand');
Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/brand-status/{id}', [BrandController::class, 'brandStatus'])->name('brand.status');


// FrontController 

Route::post('/getsubcat', [FrontController::class, 'getsubcat'])->name('getsubcat');