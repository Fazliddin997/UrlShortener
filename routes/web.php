<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/url', 'UrlController@short', function(){return view('create');});

Route::post('/create/url', 'UrlController@short');

Route::get('/create/url/{link}', 'UrlController@shortLink');

Route::get('/create/url','UrlController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
