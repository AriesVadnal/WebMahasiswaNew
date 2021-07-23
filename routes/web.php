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

Route::get('/', 'SiteController@home');

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');
Route::get('/register','SiteController@register');
Route::post('/postregister','SiteController@postregister');


Route::group(['middleware' => ['auth','checkRole:admin']], function(){
    Route::get('/siswa','SiswaController@index');
    Route::post('/siswa/create','SiswaController@create');
    Route::get('/siswa/{id}/edit','SiswaController@edit');
    Route::post('/siswa/{id}/update','SiswaController@update');
    Route::get('/siswa/{id}/delete','SiswaController@delete');
    Route::get('/siswa/{id}/profile','SiswaController@profile');
    Route::post('/siswa/{id}/editnilai','SiswaController@editnilai');
    Route::get('/siswa/{siswaId}/{mapelId}/deletenilai','SiswaController@deletenilai');
    Route::get('/siswa/exportPdf','SiswaController@exportPdf');
    Route::get('/posts','PostController@index');
    Route::get('/post/add','PostController@add');
    Route::post('/post/create','PostController@create')->name('posts.create');
    Route::get('/post/{id}/edit','PostController@edit');
    Route::post('/post/{id}/update','PostController@update')->name('posts.update');
    Route::get('/post/{id}/delete','PostController@delete');
    Route::get('/getdatasiswa','SiswaController@getdatasiswa')->name('ajax.get.data.siswa');
});


Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function(){
    Route::get('/dashboard','DashboardController@index');
    Route::get('/guru/{id}/profile','GuruController@profile');
});

Route::group(['middleware' => ['auth','checkRole:siswa']], function(){
    Route::get('/profilesaya','SiswaController@profilesaya');
    Route::get('/forum','ForumController@index');
    Route::post('/forum/create','ForumController@create');
    Route::get('/forum/{forum}/view','ForumController@view');
    Route::post('/forum/{forum}/view','ForumController@postkomentar');
});

Route::get('/singlepost/{slug}','SiteController@singlepost')->name('singlepost');