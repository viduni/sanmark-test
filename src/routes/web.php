<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeterReaderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::post('/bill-details', [CustomerController::class, 'billDetails'])->name('billDetails');
    
});
    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('meter-reader')->name('meterReader.')->group(function () {
        Route::get('/dashboard', [MeterReaderController::class, 'readingDashboard'])->name('dashboard');
        Route::post('/create-reading', [MeterReaderController::class, 'createReading'])->name('createReading');
    });
        
});

require __DIR__.'/auth.php';
