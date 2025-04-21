<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TagproductController;
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
// Route::middleware(['auth', 'verified', 'preventback'])->group(function () {
// Route::get('/', function () {
//     return view('welcome');});
// });

// Route::get('/', function () {
//     return view('welcome');});

Route::get('/',[Usercontroller::class,'index'])->name('/');
Route::get('about',[Usercontroller::class,'about'])->name('about');
Route::get('contact',[Usercontroller::class,'contact'])->name('contact');
Route::get('blogs',[Usercontroller::class,'blogs'])->name('blogs');
Route::get('service',[Usercontroller::class,'service'])->name('service');

Route::get('/products/filter/{category_id}', [Usercontroller::class, 'filter'])->name('products.filter');


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
Route::middleware(['auth', 'verified', 'preventback'])->group(function () {
Route::get('/dashboard',[admincontroller::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/viewproduct', [admincontroller::class, 'viewproduct'])->name('viewproduct');
Route::get('/hero', [HeroController::class, 'hero'])->name('hero');
Route::get('/users', [admincontroller::class, 'users'])->name('users');
Route::get('/settings', [admincontroller::class, 'settings'])->name('settings');
});

// many to many relations 
Route::get('add-tag', [TagController::class, 'add_tags']);
Route::get('add-tagproduct', [TagproductController::class, 'add_tagproduct']);
Route::get('show-tags/{id}', [TagController::class, 'show_tags']);
Route::get('show-tagproduct/{id}', [TagproductController::class, 'show_tagproduct']);

// hero banner 
Route::prefix('hero')->group(function(){
    Route::post('/save-item', [HeroController::class, 'store'])->name('hero.store');
    Route::get('/{id}/edit',[HeroController::class, 'edit'])->name('hero.edit');
    Route::post('/{id}/update', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/delete/{id}', [HeroController::class, 'delete'])->name('hero.delete');
    Route::post('/toggle-status/{id}', [HeroController::class, 'toggleStatus'])->name('hero.toggle');

});