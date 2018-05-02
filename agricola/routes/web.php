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
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');
/*
  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');
*/
  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('oferta','OfertaController');
Route::resource('anuncio','AnuncioController');
Route::post('/anuncio/update/{id}','AnuncioController@update')->name('upd');
Route::get('/anuncio/intativar/{id}','AnuncioController@inativar')->name('anuncio.inativar');
Route::post('/anuncio/intativar/{id}','AnuncioController@inativar')->name('anuncio.inativar');

Route::post('/anuncio/filt','AnuncioController@filtra')->name('anuncio.filtraranuncio');
Route::get('/anuncios/dem','AnuncioController@listarofertas')->name('anuncio.dem');
Route::get('/anuncios/ofer','AnuncioController@listarofertas')->name('anuncio.ofer');


Route::get('/anuncios/listtodos','AnuncioController@todosanuncios')->name('anuncio.listtodos');

Route::resource('demanda','DemandaController');
Route::resource('endereco','EnderecoController');
Route::resource('casaofertademanda','CasaofertademandaController');


Route::resource('foto','FotoController');

Route::get('/endereco/cidade/{id}','EnderecoController@cidade')->name('endereco.cidade');
Route::post('/endereco/cidade/{id}','EnderecoController@cidade')->name('endereco.cidade');



