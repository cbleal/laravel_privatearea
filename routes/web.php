<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Main@index')->name('index');
Route::get('/login', 'Main@login')->name('login');
Route::post('/login_submit', 'Main@login_submit')->name('login_submit');

Route::get('/home', 'Main@home')->name('home');
Route::get('/logout', 'Main@logout')->name('logout');