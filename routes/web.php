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

Auth::routes();

Route::get('/tarefa/create', 'tarefasController@create');
Route::post('/tarefa', 'tarefasController@store');

Route::get('/tarefa/{tarefa}/edit', 'tarefasController@edit')->name('tarefas.edit');
Route::patch('/tarefa/{tarefa}', 'tarefasController@update')->name('tarefas.update');
Route::put('/tarefa/trocaOrdem', 'tarefasController@trocaOrdem')->name('tarefas.trocaOrdem');


Route::get('/tarefa/{tarefa}/delete', 'tarefasController@destroy')->name('tarefas.delete');


Route::get('/home', 'HomeController@index')->name('home');
