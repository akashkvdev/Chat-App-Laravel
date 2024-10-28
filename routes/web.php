<?php

use App\Http\Controllers\ChatController;
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
Route::get('', [ChatController::class, 'index'])->name('user.login');
Route::post('/broadCast', [ChatController::class, 'broadCastChat'])->name('broadCast.chat');
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');