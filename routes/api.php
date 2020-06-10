<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/store', 'ContactController@store')->name('store');
