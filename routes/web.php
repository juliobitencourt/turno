<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\TransactionController;

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
});

Route::post('register', [UserController::class, 'register'])->name('register');

Route::get('login', function() {
    return 'foo';
})->name('login');

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('home', function () {
        return view('home');
    })->name('home');

    Route::post('checks', [CheckController::class, 'store'])->name('checks.create');
    Route::post('purchases', [TransactionController::class, 'createPurchase'])->name('purchases.create');

    Route::get('expenses', [TransactionController::class, 'getExpenses'])->name('expenses');
});