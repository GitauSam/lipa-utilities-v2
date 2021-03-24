<?php

use App\Http\Controllers\Utility\Payment\MpesaController;
use App\Http\Controllers\Utility\UserUtilityController;
use App\Http\Controllers\Utility\UtilityController;
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


Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    // Utility routes
    Route::resource('utility', UserUtilityController::class);

    // Utility Payment routes
    Route::get('utility/pay/mpesa/{id}', [MpesaController::class, 'showLipaNaMpesa'])
        ->name('utility.lipa-na-mpesa.get');
    Route::post('utility/pay/mpesa', [MpesaController::class, 'executeLipaNaMpesaTransaction'])
        ->name('utility.lipa-na-mpesa');

    // Admin routes
    Route::group(['middleware' => ['role:super-admin|moderator']], function() {
        
        // Utility routes
        Route::prefix('admin')->group(function() {
                Route::name('admin.')->group(function() {
                        Route::resource('utility', UtilityController::class);
                });
        });
        
    });

    // Dashboard
    Route::get('/dashboard', function() {
            return view('dashboard');
    })->name('dashboard');

});
