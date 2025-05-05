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
use App\Http\Controllers\SubscriptionAdminController;
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



require __DIR__.'/auth.php';


// admin routes --------------------

// many to many relations 
Route::get('add-tag', [TagController::class, 'add_tags']);
Route::get('add-tagproduct', [TagproductController::class, 'add_tagproduct']);
Route::get('show-tags/{id}', [TagController::class, 'show_tags']);
Route::get('show-tagproduct/{id}', [TagproductController::class, 'show_tagproduct']);



// Razor pay code 
Route::post('/razorpay-payment', [razorpaycontroller::class, 'payment'])->name('razorpay.payment');
Route::get('/order-success/{orderId}', [razorpaycontroller::class, 'orderSuccess'])->name('order.success');





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



// plans 
Route::get('/subscription',[SubscriptionController::class,'subscription']);

Route::get('/',[SubscriptionController::class,'subscription'])->name('/');
Route::resource('plans', PlanController::class);
Route::resource('features', FeatureController::class);



//subscription payemtn
Route::post('/razorpay/create-order', [razorpaycontroller::class, 'createOrder'])->name('razorpay.create.order');
Route::get('/tenant/success', [TenantController::class, 'success'])->name('tenant.success');



// dashboard
Route::get('/admindashboard',[SubscriptionAdminController::class,'index'])->name('admindashboard');
Route::get('/adminsettings', [SubscriptionAdminController::class, 'settings'])->name('settings');

Route::resource('tanent',TenantController::class)->middleware(['auth', 'verified']);
Route::post('tanent/store',[TenantController::class,'store'])->name('tenant.store');
