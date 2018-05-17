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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'CATALOGO'], function () {

  Route::view('/eliminarProducto/{id}', 'CATALOGO.eliminarProducto', ['name' => 'eliminarProducto']);
  Route::view('/ModificarProducto/{id}', 'CATALOGO.modificarProducto', ['name' => 'modificarProducto']);
  Route::view('/ListadoDeProductos/{id}', 'CATALOGO.listaProductos', ['name' => 'listaProductos']);
  Route::view('/nuevoProducto', 'CATALOGO.nuevoProducto', ['name' => 'nuevoProducto']);
  Route::view('/indexCatalogo', 'CATALOGO.indexCatalogo', ['name' => 'indexCatalogo']);

 });

Route::group(['prefix' => 'CIRUGIAS'], function () {

  Route::view('/fichaCirugia/{id}', 'CIRUGIAS.fichaCirugia', ['name' => 'fichaCirugia']);
  Route::view('/listaDeCirugias', 'CIRUGIAS.listaCirugia', ['name' => 'listaDeCirugias']);
  Route::view('/registrarCirugia', 'CIRUGIAS.registrarCirugia', ['name' => 'registrarCirugia']);
  Route::view('/modificarCirugia', 'CIRUGIAS.modificarCirugia', ['name' => 'modificarCirugia']);
  Route::view('/indexCirugias', 'CIRUGIAS.indexCirugias', ['name' => 'indexCirugias']);

});



 Route::group(['prefix' => 'BODEGA'], function () {

    Route::view('/indexBodega', 'BODEGA.indexBodega', ['name' => 'indexBodega']);

    Route::group(['prefix' => 'MERMAS'], function () {
      Route::view('/ingresoDeProductos', 'BODEGA.ingresoDeProductos', ['name' => 'ingresoDeProductos']);
    });

    Route::group(['prefix' => 'INGRESOS'], function () {
      Route::view('/registroDeMermas', 'BODEGA.registroDeMermas', ['name' => 'registroDeMermas']);
    });

    Route::group(['prefix' => 'PRESTAMO'], function () {
      Route::view('/modificarCirugia', 'BODEGA.modificarCirugia', ['name' => 'modificarCirugia']);
    });

  });
