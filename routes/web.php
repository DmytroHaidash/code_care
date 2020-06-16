<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// User interface
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'user::', 'middleware' => ['auth']], function () {
    Route::get('/hashes', 'HomeController@index')->name('hashes');
    Route::post('/hash', 'HashController@store')->name('hash.save');
    Route::delete('/hash/{hash}','HashController@destroy')->name('hash.delete');

});

// Rest api
Route::group(['as' => 'api::', 'middleware' => ['auth']], function () {
    Route::get('/api/hashes', 'HashController@index')->name('api/hashes');
    Route::get('/api/hashes/{id}', 'HashController@show')->name('api/hashes/id');
});

// Main intarface
Route::get('/show-xml', 'HomeController@showFiles')->name('showXml::get');
Route::get('/', 'VocabularyController@index')->name('HashGenerator::get');
Route::post('/', 'VocabularyController@hashView')->name('HashGenerator::post');

// Auth routes
Auth::routes();


