<?php

use App\Http\Controllers\billingController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
    echo "we are working fine";
});

Route::get('/billing',[billingController::class,'index'])->name('billing');

Route::get('/billing/new',[billingController::class,'newBill'])->name('new-bill');

Route::get('/billing/invoice-editor/{id}',[billingController::class,'invoiceEditor'])->name('invoice-editor');

Route::post('/billing/save',[billingController::class,'Save'])->name('save-bill');

Route::post('/billing/update',[billingController::class,'Update'])->name('update-bill');

Route::get('/php/artisan',function(){
    Artisan::call('migrate');
});
