<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImportProductsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\UserController;
use App\Jobs\ImportProducts;
use Illuminate\Support\Facades\Route;
Route::prefix('admin/dashboard')
// ->middleware(['auth' ,'checkUser:admin,super-admin'])
->middleware(['auth:admin'])// any guard ['auth:admin,web' ]
->as('dashboard.')
->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

     //Products jop
     Route::get('products/import' , [ImportProductsController::class , 'create'])->name('products.import');
     Route::post('products/import' , [ImportProductsController::class , 'store'])->name('products.import');

    Route::get('profile' , [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('profile' , [ProfileController::class , 'update'])->name('profile.update');

    Route::get('categories/trash' , [CategoriesController::class , 'trash'])->name('categories.trash');
    Route::put('categories/restore/{category}' , [CategoriesController::class , 'restore'])->name('categories.restore');
    Route::resource('products' , ProductController::class);

    Route::delete('categories/forceDelete/{category}' , [CategoriesController::class , 'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/admins' , AdminController::class);
    Route::resource('/products', ProductController::class);

    Route::resource('/stores', StoreController::class);
    Route::resource('/roles', RolesController::class);

    Route::resource('/orders', OrdersController::class);
    Route::resource('/users', UserController::class);


});
