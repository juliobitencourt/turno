<?php

use App\Http\Middleware\UserIsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserIsCustomer;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CheckController;
use App\Http\Controllers\Customer\ExpenseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\Admin\AcceptCheckController;
use App\Http\Controllers\Admin\RejectCheckController;
use App\Http\Controllers\Admin\CheckControlController;

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
    return view('welcome');
})->name('welcome');

Route::post('register', UserRegisterController::class)->name('register');

Route::prefix('login')->group(function () {
    Route::get('/', function() {
        return view('login');
    })->name('login');

    Route::post('/', LoginController::class)->name('login.create');
});

Route::post('logout', LogoutController::class)->name('logout');

Route::middleware([
    'auth:sanctum',
    UserIsCustomer::class
])->group(function () {
    Route::get('home/{month?}', HomeController::class)->name('home');

    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('expenses');
        Route::get('/new', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::post('/new', [ExpenseController::class, 'store'])->name('expenses.store');
    });

    Route::prefix('checks')->group(function () {
        Route::get('/', [CheckController::class, 'index'])->name('checks');
        Route::get('/new', [CheckController::class, 'create'])->name('checks.create');
        Route::post('/new', [CheckController::class, 'store'])->name('checks.store');
    });
});

Route::middleware([
    'auth:sanctum',
    UserIsAdmin::class
])->prefix('admin')->group(function () {
    Route::prefix('checks')->group(function () {
        Route::get('/', [CheckControlController::class, 'index'])->name('admin.checks');
        Route::get('/{check}', [CheckControlController::class, 'show'])->name('admin.checks.show');
        Route::put('/reject/{check}', RejectCheckController::class)->name('admin.reject-check');
        Route::put('/accept/{check}', AcceptCheckController::class)->name('admin.accept-check');
    });
});