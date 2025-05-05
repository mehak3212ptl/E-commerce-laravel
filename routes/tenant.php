<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Usercontroller;

use App\Http\Controllers\admincontroller;
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

    Route::get('/',[Usercontroller::class,'index1'])->name('index');

    Route::get('/dashboard', function () {
        return view('dashboard');
        
    });



   
   require __DIR__.'/user-auth.php';


});