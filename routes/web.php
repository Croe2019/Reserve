<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivewireController;
use App\Http\Controllers\AlpineController;
use PhpParser\Node\Expr\FuncCall;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(LivewireController::class)
->prefix('livewire')->group(function(){
    Route::get('index', 'index');
    Route::get('register', 'register');
});

Route::get('alpine/index', [AlpineController::class, 'index']);