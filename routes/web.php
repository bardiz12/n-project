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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/survey/buat','SurveyController@buat')->name('survey.create');
