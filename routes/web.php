<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    redirect('/login');
});

Auth::routes();
Route::get('/admin/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*')->name('home');
