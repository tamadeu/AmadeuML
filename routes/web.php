<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'App\Http\Controllers\IndexController@index')->middleware(['auth', 'verified'])->name('index');

Route::get('/new', 'App\Http\Controllers\ChatController@newChat')->middleware(['auth', 'verified'])->name('new');


Route::post('/chat', 'App\Http\Controllers\ChatController@chat')->middleware(['auth', 'verified']);

Route::get('/chat/{randomId}', 'App\Http\Controllers\ChatController@getChatId')->middleware(['auth', 'verified'])->name('chatRandomId');

Route::post('/chat/{randomId}', 'App\Http\Controllers\ChatController@postChatId')->middleware(['auth', 'verified'])->name('postChatRandomId');


// botão de reset

Route::get('/reset', 'App\Http\Controllers\ChatController@resetChatId')->middleware(['auth', 'verified']);

// exclui um chat e suas mensagens

Route::delete('/chats/{id}', 'App\Http\Controllers\ChatController@deleteChat')->middleware(['auth', 'verified'])->name('chats.delete');



// Rotas do perfil

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Outras páginas

Route::view('/politica_de_privacidade', 'politica');

Route::view('/termos_de_servico', 'termos');

// Login com o Google

Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');


require __DIR__.'/auth.php';
