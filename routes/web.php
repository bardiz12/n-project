<?php

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

Route::get('/', function () {
    return view('front.index');
});
Route::get('/tes', function () {

});
Route::get('/tes2', function () {
    return view('front.login');
});
Route::get('/admin', function () {
    return view('layouts.admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'survey','as'=>'survey.','middleware'=>['auth']], function () {
    Route::get('/create','SurveyController@buat')->name('create');
    Route::post('/save','SurveyController@store')->name('store');
    Route::get('/write/{id}','SurveyController@write')->name('write')->middleware(['formAccess.write']);
    Route::post('/write/{id}/save','SurveyController@saveWrite')->name('write.save')->middleware(['formAccess.write']);
});
