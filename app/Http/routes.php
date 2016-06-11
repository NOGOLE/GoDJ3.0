<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as'=>'home',function () {
    return view('welcome');
}]);

Route::post('/buy-tickets', 'PartyController@buyTickets');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::group(['prefix' => 'party'], function(){
    Route::get('all', 'PartyController@index');
    Route::get('add', 'PartyController@create');
    });

    Route::get('/home', 'HomeController@index');
    Route::resource('song-request','SongRequestController');
    Route::resource('mood-request','MoodRequestController');
    Route::resource('party', 'PartyController');

});
