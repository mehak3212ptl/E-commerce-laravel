<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\adminController;

use App\Http\Controllers\TenantController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\razorpaycontroller;
use App\Http\Controllers\UseraboutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SpatieUserController;
use App\Http\Controllers\TagproductController;
use App\Http\Controllers\SubscriptionController;
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



// User interface 
Route::get('index',[Usercontroller::class,'index1'])->name('index');
Route::get('aboutus',[Usercontroller::class,'about'])->name('aboutus');
Route::get('contact',[Usercontroller::class,'contact'])->name('contact');
Route::get('blogs',[Usercontroller::class,'blogs'])->name('blogs');
Route::get('service',[Usercontroller::class,'service'])->name('service');
Route::get('/products/filter/{category_id}', [Usercontroller::class, 'filter'])->name('products.filter');
Route::get('detail/{id}',[Usercontroller::class,'detail'])->name('detail');
Route::get('/wishlist', [Usercontroller::class, 'index'])->name('wishlist');
Route::post('/wishlist/add/{id}', [Usercontroller::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{id}', [Usercontroller::class, 'remove'])->name('wishlist.remove');




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
Route::middleware(['verified', 'preventback',])->group(function () {
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
// Razor pay code 
Route::post('/razorpay-payment', [razorpaycontroller::class, 'payment'])->name('razorpay.payment');
Route::get('/order-success/{orderId}', [razorpaycontroller::class, 'orderSuccess'])->name('order.success');

// About us 
Route::group(['middleware'=>'role:super-admin|Admin'],function(){ 
Route::get('/about', [UseraboutController::class, 'index'])->name('about');
Route::get('/about/create', [UseraboutController::class, 'create']);
Route::post('/about', [UseraboutController::class, 'store']);
Route::get('/about/{id}/edit', [UseraboutController::class, 'edit']);
Route::post('/about/{id}/update', [UseraboutController::class, 'update']);
Route::get('/about/{id}/delete', [UseraboutController::class, 'delete']);
});



// role and permission 


Route::group(['middleware'=>'role:super-admin'],function(){ 
// PERMISSIOM 
Route::resource('permissions',PermissionController::class);
Route::get('permissions/{permissionId}/delete',[PermissionController::class,'destroy']);

// ROLES 
Route::resource('roles',RoleController::class);
Route::get('roles/{roleId}/delete',[RoleController::class,'destroy']);

Route::get('roles/{roleId}/give-permissions',[RoleController::class,'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions',[RoleController::class,'givePermissionToRole']);


Route::resource('users',SpatieUserController::class);
Route::get('users/{userId}/delete',[SpatieUserController::class,'destroy']);

});



Route::resource('tanent',TenantController::class)->middleware(['auth', 'verified']);
Route::post('tanent/store',[TenantController::class,'store'])->name('tenant.store');


// plans 
Route::get('/subscription',[SubscriptionController::class,'subscription']);

Route::get('/',[SubscriptionController::class,'subscription'])->name('/');
Route::resource('plans', PlanController::class);
Route::resource('features', FeatureController::class);



//subscription payemtn
Route::post('/razorpay/create-order', [razorpaycontroller::class, 'createOrder'])->name('razorpay.create.order');
Route::get('/tenant/success', [TenantController::class, 'success'])->name('tenant.success');