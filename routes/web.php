<?php

use App\Http\Controllers\ProfileController;
use App\Models\Task;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {

            return Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        });



        Route::get('/plans', function () {
            return view('plans');
        })->middleware('auth');

        Route::get('checkout', function (Request $request) {
            return $request->user()->newSubscription(
                'prod_RIkaVfSy4Z30dQ',
                $request->plan
            )->checkout([
                        'success_url' => route('success'),
                        'cancel_url' => route('cancel'),
                    ]);

        })->name('checkout');

        Route::get('success', function () {
            dd('success');
        })->name('success');

        Route::get('cancel', function () {
            dd('cancel');
        })->name('cancel');


        // Authentication Web's
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        require __DIR__ . '/auth.php';
    });

}