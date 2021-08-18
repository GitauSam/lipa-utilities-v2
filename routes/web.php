<?php

use App\Http\Controllers\Utility\Payment\MpesaController;
use App\Http\Controllers\Utility\UserUtilityController;
use App\Http\Controllers\Utility\UtilityController;
use App\Http\Controllers\Utility\UtilityPaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('landing-page-v3');
});

// Route::get('/landing-page-beta', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum'])->group(function() {

    // Email verification routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        $request->fulfill();
    
        if (auth()->user()->hasRole(config('services.general.user_role'))) { 
            return redirect()->route('utility.index'); 
        }

        return redirect()->route('admin.utility.index');

    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    Route::middleware(['verified'])->group(function() {

        Route::get('/dashboard-v2', function () {
            return view('dashboard-v2');
        });

        // Utility routes
        Route::resource('utility', UserUtilityController::class);

        // Utility payments routes
        Route::resource('payments', UtilityPaymentController::class);

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

                    // Dashboard
            Route::get('/dashboard', function() {
                            return view('dashboard');
                    })->name('dashboard');
            });
            
        });

    });

});
