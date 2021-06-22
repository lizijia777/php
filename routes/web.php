<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Index@index');

Route::post('/login','Login@login');

Route::post('/register','Login@register');

Route::get('/HomePage','Index@HomePage');

Route::get('/select','Index@select');

Route::get('/loginout','Index@loginout');

Route::post('/reserve','Index@reserve');

Route::post('/checkCode','Login@checkCode');

Route::get('/siginPage','Login@siginPage');

Route::post('/quxiao','Index@quxiao');
