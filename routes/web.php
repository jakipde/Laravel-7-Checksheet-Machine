<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');
Route::get('/main/refresh', 'MainController@refresh')->name('main.refresh');
Route::resource('main', 'MainController')->except(['show']);
Route::get('main/{main}', [MainController::class, 'show'])->name('main.show');  