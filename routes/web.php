<?php

#use App\Classes\Tools;

use App\Mail\EmailTeste;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Main@index')->name('index');
Route::get('/login', 'Main@login')->name('login');
Route::post('/login_submit', 'Main@login_submit')->name('login_submit');

Route::get('/home', 'Main@home')->name('home');
Route::get('/logout', 'Main@logout')->name('logout');

Route::get('/facade', function () {
    Tools::printData('Micropoint');
    
    $v = [1, 2, 3];
    Tools::printData($v);

    Tools::teste();
});

Route::get('/constantes', function () {
    echo config('constants.VERSAO');
    echo "<br>";
    echo config('constants.MYSQL_HOST');
});

Route::get('/email', function() {
    Mail::to('cborgesleal@hotmail.com')->send(new EmailTeste());            
    echo 'E-mail enviado.';
});

Route::get('/encript/{id}', 'Main@edit')->name('main_edit');
Route::get('/desencript/{hash}', 'Main@final')->name('main_final');

Route::get('/edit/{id}', 'Main@edit')->name('main_edit');

Route::post('/upload', 'Main@upload')->name('main_upload');

Route::get('/list_files', 'Main@list_files')->name('main_list_files');
Route::get('/download/{file}', 'Main@download')->name('main_download');
