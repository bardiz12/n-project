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
Route::get('/hasil_pemilu','hasilController@hasil');
Route::get('/admin', function () {
    return view('layouts.admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'survey','as'=>'survey.','middleware'=>['auth']], function () {
    Route::get('/{id}/response/','SurveyController@write')->name('write')->middleware(['formAccess.write']);
    Route::get('/{id}/maps/','SurveyController@maps')->name('map')->middleware(['formAccess.write']);
    Route::group(['prefix' => 'report','middleware'=>['formAccess.admin']], function () {

    });
    Route::post('/{id}/response/save','SurveyController@saveWrite')->name('write.save')->middleware(['formAccess.write']);
});

Route::group(['prefix' => 'account','as'=>'account.','middleware'=>['auth']],function(){
    Route::get('/','AccountController@index')->name('index');
    Route::group(['prefix' => 'survey','as'=>'survey.'], function () {
        Route::get('/create','SurveyController@buat')->name('create');
        Route::post('/save','SurveyController@store')->name('store');
        Route::get('/{id}/maintainer','SurveyController@maintainerIndex')->name('maintainer.index')->middleware(['formAccess.admin']);
        Route::post('/{id}/maintainer/promotion','SurveyController@maintainerPromotion')->name('maintainer.promotion')->middleware(['formAccess.admin']);
        Route::post('/{id}/maintainer/add','SurveyController@maintainerAdd')->middleware(['formAccess.admin'])->name('maintainer.add');
        Route::post('/{id}/maintainer/remove','SurveyController@maintainerRemove')->name('maintainer.remove')->middleware(['formAccess.admin']);
        
        Route::group(['prefix'=>'{id}/report','as'=>'report.'],function(){
            Route::get('/','SurveyReportController@index')->name('index')->middleware(['formAccess.admin']);
            Route::get('/new','SurveyReportController@create')->name('create')->middleware(['formAccess.admin']);
        });
    });
    Route::group(['prefix' => 'invitation','as'=>'invitation.'], function () {
        Route::post('/save','InvitationController@store')->name('save');
        Route::post('/remove','InvitationController@remove')->name('remove');
    });
    Route::get('/surveys','AccountController@surveysIndex')->name('surveys');
    Route::get('/invitations', 'AccountController@invitationsIndex')->name('invitations');
    Route::get('/survey_pemilu', 'AccountController@survey_pemilu')->name('survey_pemilu');
    Route::post('/survey_pemilu', 'AccountController@pilih_dpr')->name('pilih_dpr');
});
