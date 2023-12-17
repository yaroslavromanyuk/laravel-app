<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');
Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');
Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
