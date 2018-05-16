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

route::get('/inicio','ResumidoController@index')->name('resumido');
Route::get('/', function () {
    return redirect()->route('resumido');
    //return view('welcome');
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
Route::get('/anuncios/recomendados','AnuncioController@recomendados')->name('anuncio.recomendados');

Route::post('/recomendacao/{id}','RecomendacaoController@guardar')->name('recomendacao.guardar');

Route::get('/anuncios/listtodos','AnuncioController@todosanuncios')->name('anuncio.listtodos');

Route::resource('demanda','DemandaController');
Route::resource('endereco','EnderecoController');
Route::post('enderecos/update/{id}','EnderecoController@update')->name('end.update');


Route::resource('casaofertademanda','CasaofertademandaController');
Route::resource('user','UserController');

Route::resource('foto','FotoController');

Route::get('/endereco/cidade/{id}','EnderecoController@cidade')->name('endereco.cidade');
Route::post('/endereco/cidade/{id}','EnderecoController@cidade')->name('endereco.cidade');

Route::post('/fotos/addAnuncio/{id}','FotoController@storeAnuncio')->name('foto.storeanuncio');

Route::get('/usuario/intativar/{id}','UserController@inativar')->name('usuario.inativar');
Route::post('/user/inativar/','UserController@inativar')->name('user.inativar');
Route::post('/usuario/update/','UserController@update')->name('usuario.update');

Route::get('/usuario/exibeoutro/{id}','UserController@exibeoutro')->name('usuario.exibeoutro');
Route::get('/usuario/todos/{id}','UserController@todos')->name('usuario.todos');
Route::get('usuario/alterarsenha/','UserController@alterarsenha')->name('usuario.alterarsenha');
Route::post('usuario/salvarsenha/','UserController@salvarsenha')->name('usuario.salvarsenha');


Route::post('/email/enviar/{id}', 'EmailController@enviar')->name('email.enviar');

Route::resource('/avaliacao','AvaliacaoController');
Route::post('/avaliacao/gravar/{id}','AvaliacaoController@gravar')->name('avaliacao.gravar');

Route::get('/solicitacao/{id}','SolicitacaoController@store')->name('solicitacao.store');
Route::get('/solicitacao/aceitar/{id}','SolicitacaoController@aceitar')->name('solicitacao.aceitar');
Route::get('/solicitacao/excluir/{id}','SolicitacaoController@excluir')->name('solicitacao.excluir');

Route::get('/fotos/excluir/{id}','FotoController@excluir')->name('fotos.excluir');
Route::post('/fotos/apagar/{id}','FotoController@apagar')->name('fotos.apagar');

Route::get('/amizades','AmizadesController@show')->name('amizades.show');
Route::get('/amizades/{id}','AmizadesController@excluir')->name('amizade.excluir');

Route::get('recomendacao/excluir{id}','RecomendacaoController@excluir')->name('recomendacao.excluir');



