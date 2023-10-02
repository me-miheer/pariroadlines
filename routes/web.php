<?php

use App\Http\Controllers\billingController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('billing');
});

//  Billing

Route::group(['prefix' => 'billing'], function(){

    // Get Routes
    
    Route::get('/',[billingController::class,'index'])->name('billing');
        
    Route::get('new',[billingController::class,'newBill'])->name('new-bill');
    
    Route::get('invoice-editor/{id}',[billingController::class,'invoiceEditor'])->name('invoice-editor');
    
    Route::get('invoice-delete/{id}',[billingController::class,'invoiceDelete'])->name('invoice-delete');
    
    Route::get('invoice/{id}',[billingController::class,'InvoiceShared'])->name('invoice-share');

    // Post Routes
    
    Route::post('save',[billingController::class,'Save'])->name('save-bill');
    
    Route::post('delete',[billingController::class,'Delete'])->name('delete-bill');
    
    Route::post('update',[billingController::class,'Update'])->name('update-bill');

    // Profile Group

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', [ProfileController::class,'index'])->name('profile');

        Route::get('/new', [ProfileController::class,'Create'])->name('new-profile');

        Route::post('/save-profile', [ProfileController::class,'Save'])->name('save-profile');

        Route::post('/update-profile', [ProfileController::class,'Update'])->name('update-profile');

    });

});

Route::get('/php/artisan',function(){
    Artisan::call('storage:link');
    Artisan::call('migrate');
});
