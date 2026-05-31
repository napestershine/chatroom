<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Message;
use App\Events\MessagePosted;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::get('/messages', function () {
    return Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function () {
    $user = Auth::user();

    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);

    broadcast(new MessagePosted($message, $user))->toOthers();

    return ['status' => 'OK'];
})->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
