<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\DashboardController;
Route::group(['domain' => ''], function() {
    Route::get('auth',[AuthController::class, 'index'])->name('auth.index');
    Route::prefix('/')->name('web.')->group(function(){
        Route::prefix('auth')->name('auth.')->group(function(){
            Route::post('login',[AuthController::class, 'do_login'])->name('login');
            Route::post('register',[AuthController::class, 'do_register'])->name('register');
            Route::post('forgot',[AuthController::class, 'do_forgot'])->name('forgot');
            Route::get('reset/{token}',[AuthController::class, 'reset'])->name('getreset');
            Route::post('reset',[AuthController::class, 'do_reset'])->name('reset');
        });

        Route::middleware(['auth:web'])->group(function(){
            Route::redirect('/', 'dashboard', 301);
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
           
            // PROFILE
            Route::prefix('profile')->name('profile.')->group(function(){
                Route::get('', [ProfileController::class, 'index'])->name('index');
                Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
                Route::post('cpassword', [ProfileController::class, 'cpassword'])->name('cpassword');
                Route::post('save', [ProfileController::class, 'save'])->name('save');
            });

            Route::get('logout',[AuthController::class, 'do_logout'])->name('auth.logout');

            Route::get('migrate', function(){
                Artisan::call('migrate');
                return response()->json([
                    'alert' => 'success',
                    'message' => 'DB Migrate!'
                ]);
            })->name('db.migrate');
            Route::get('storage-link', function(){
                Artisan::call('storage:link');
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Storage Linked!'
                ]);
            })->name('storage.link');
            Route::get('db-seed', function(){
                Artisan::call('db:seed');
                return response()->json([
                    'alert' => 'success',
                    'message' => 'DB Seed!'
                ]);
            })->name('db.seed');
        });
    });
});