<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UseraboutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FooterController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'tenant.active',
])->group(function () {
    // Route::get('/', function () {
    //     return view('app.userpage');
    // });





// User interface 
Route::get('/',[Usercontroller::class,'index1'])->name('index');
Route::get('aboutus',[Usercontroller::class,'about'])->name('aboutus');
Route::get('contact',[Usercontroller::class,'contact'])->name('contact');
Route::get('blogs',[Usercontroller::class,'blogs'])->name('blogs');
Route::get('service',[Usercontroller::class,'service'])->name('service');
Route::get('/products/filter/{category_id}', [Usercontroller::class, 'filter'])->name('products.filter');
Route::get('detail/{id}',[Usercontroller::class,'detail'])->name('detail');
Route::get('/wishlist', [UserController::class, 'index']);
Route::post('/wishlist/add/{id}', [UserController::class, 'add']);
Route::post('/wishlist/remove/{id}', [UserController::class, 'remove']);
// stripe integration 
Route::get('success',[Usercontroller::class,'success']);
Route::post('/stripe/checkout', [Usercontroller::class, 'checkout'])->name('stripe.checkout');




// dashboard default
 Route::get('/dashboard',[admincontroller::class,'index']);
 Route::get('/viewproduct', [admincontroller::class, 'viewproduct']);
Route::get('/hero', [HeroController::class, 'hero']);
Route::get('/users', [admincontroller::class, 'users']);
Route::get('/settings', [admincontroller::class, 'settings']);
        
// hero banner        
Route::post('/herosaveitem', [HeroController::class, 'store']);
Route::get('/{id}/edit',[HeroController::class, 'edit']);
Route::post('/{id}/heroupdate', [HeroController::class, 'update']);
Route::delete('/delete/{id}', [HeroController::class, 'delete']);
Route::post('/toggle-status/{id}', [HeroController::class, 'toggleStatus']);
        
       


    // About us 
    Route::get('/about', [UseraboutController::class, 'index'])->name('about');
    Route::get('/about/create', [UseraboutController::class, 'create']);
    Route::post('/about', [UseraboutController::class, 'store']);
    Route::get('/about/{id}/edit', [UseraboutController::class, 'edit']);
    Route::post('/about/{id}/update', [UseraboutController::class, 'update']);
    Route::get('/about/{id}/delete', [UseraboutController::class, 'delete']);
 

// ----------------------Ajax crud routes -------------------

Route::get('/products/fetch', [ProductsController::class, 'index']);
Route::post('/storeproducts', [ProductsController::class, 'store']);
Route::get('/products/{id}/edit', [ProductsController::class, 'edit']);
Route::post('/products/{id}/update', [ProductsController::class, 'update']);
Route::delete('/products/delete/{id}', [ProductsController::class, 'destory']);
// role and permission 

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



    // footer section 
    // Footer Management Routes

    // Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    
    // // Create and store routes
    // Route::get('/footer/create/{type}', [FooterController::class, 'create'])->name('footer.create');
    // Route::post('/footer/store', [FooterController::class, 'store'])->name('footer.store');
    
    // // Edit and update routes
    // Route::get('/footer/edit/{type}/{id?}', [FooterController::class, 'edit'])->name('footer.edit');
    // Route::put('/footer/update/{type}/{id?}', [FooterController::class, 'update'])->name('footer.update');
    
    // // Delete route
    // Route::delete('/footer/destroy/{type}/{id}', [FooterController::class, 'destroy'])->name('footer.destroy');
    
    // // Update order route
    // Route::post('/footer/update-order', [FooterController::class, 'updateOrder'])->name('footer.updateOrder');

    
    Route::prefix('admin/footer')->group(function () {
        Route::get('/', [FooterController::class, 'index'])->name('admin.footer.index');
        Route::get('create/{type}', [FooterController::class, 'create']);
        Route::post('store', [FooterController::class, 'store']); // <-- Ensure this exists
        Route::get('edit/{type}/{id?}', [FooterController::class, 'edit']);
        Route::put('update/{type}', [FooterController::class, 'update']);
        Route::post('delete/{type}/{id}', [FooterController::class, 'destroy']);
        Route::post('update-order', [FooterController::class, 'updateOrder']);
    });
    
   
   require __DIR__.'/user-auth.php';


});