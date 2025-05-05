<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;

use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UseraboutController;
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
Route::get('/wishlist', [Usercontroller::class, 'index'])->name('wishlist');
Route::post('/wishlist/add/{id}', [Usercontroller::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{id}', [Usercontroller::class, 'remove'])->name('wishlist.remove');




// dashboard default
 Route::get('/dashboard',[admincontroller::class,'index']);
        Route::get('/viewproduct', [admincontroller::class, 'viewproduct']);
        Route::get('/hero', [HeroController::class, 'hero']);
        Route::get('/users', [admincontroller::class, 'users']);
        Route::get('/settings', [admincontroller::class, 'settings']);
        
        // hero banner 
        Route::prefix('hero')->group(function(){
            Route::post('/herosaveitem', [HeroController::class, 'store'])->name('hero.store');
            Route::get('/{id}/edit',[HeroController::class, 'edit'])->name('hero.edit');
            Route::post('/{id}/update', [HeroController::class, 'update'])->name('hero.update');
            Route::delete('/delete/{id}', [HeroController::class, 'delete'])->name('hero.delete');
            Route::post('/toggle-status/{id}', [HeroController::class, 'toggleStatus'])->name('hero.toggle');
        
        });


    // About us 
    Route::get('/about', [UseraboutController::class, 'index'])->name('about');
    Route::get('/about/create', [UseraboutController::class, 'create']);
    Route::post('/about', [UseraboutController::class, 'store']);
    Route::get('/about/{id}/edit', [UseraboutController::class, 'edit']);
    Route::post('/about/{id}/update', [UseraboutController::class, 'update']);
    Route::get('/about/{id}/delete', [UseraboutController::class, 'delete']);
 

// ----------------------Ajax crud routes -------------------


Route::get('/products', [ProductsController::class, 'index'])->name('tenant.products.index');
Route::get('/products/fetch', [ProductsController::class, 'fetch'])->name('tenant.products.fetch');
Route::post('/storeproducts', [ProductsController::class, 'store'])->name('tenant.products.store');
Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('tenant.products.edit');
Route::put('/products/{id}/update', [ProductsController::class, 'update'])->name('tenant.products.update');
Route::delete('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('tenant.products.destroy');



   
   require __DIR__.'/user-auth.php';


});