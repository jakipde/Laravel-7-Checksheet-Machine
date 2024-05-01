<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');
Route::resource('main', 'MainController')->except(['show', 'destroy']);
Route::delete('main/{date}', 'MainController@destroy')->name('main.destroy');
