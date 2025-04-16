<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\adminController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------Ajax crud routes -------------------
Route::get('index1', [ProductsController::class, 'index'])->name('product.index');

Route::prefix('products')->group(function(){
    Route::post('/save-item', [ProductsController::class, 'store'])->name('product.store');
    Route::get('/{id}/edit',[ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/{id}/update', [ProductsController::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');
});

require __DIR__.'/auth.php';


// admin routes --------------------
Route::get('/dashboard',[admincontroller::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/viewproduct', [admincontroller::class, 'viewproduct'])->name('viewproduct');
