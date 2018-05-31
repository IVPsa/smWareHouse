<?php

  /*
-|--------------------------------------------------------------------------
-| Web Routes
-|--------------------------------------------------------------------------
-|
-| Here is where you can register web routes for your application. These
-| routes are loaded by the RouteServiceProvider within a group which
-| contains the "web" middleware group. Now create something great!
-|
-*/

Route::get('/', function () {
   return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('CATALOGO')->group(function () {

 Route::view('/eliminarProducto/{id}', 'CATALOGO.eliminarProducto')->name('eliminarProducto');
 Route::view('/ModificarProducto/{id}', 'CATALOGO.modificarProducto')->name('modificarProducto');

 // Route::view('/ListadoDeProductos', 'CATALOGO.listaProductos')->name('listaProductos');

   Route::get('/ListadoDeProductos', [
     'uses' => 'CatalogoProductosController@listaProductos',
   ])->name('listaProductos');

 Route::get('/fichaDeProducto/{id}', [
   'uses' => 'CatalogoProductosController@fichaDeProducto',
 ])->name('fichaDeProducto');

 // Route::view('/nuevoProducto', 'CATALOGO.nuevoProducto')->name('nuevoProducto');

 Route::get('/nuevoProducto', [
   'uses' => 'CatalogoProductosController@showCrearProducto',
 ])->name('nuevoProducto');

 Route::post('/nuevoProducto', [
   'uses' => 'CatalogoProductosController@createProducto',
   'as' => 'createProducto',
 ])->name('nuevoProducto');

 Route::view('/index', 'CATALOGO.indexCatalogo')->name('catalogo');

});

Route::group(['prefix' => 'CIRUGIAS'], function () {

 Route::view('/registrarCirugia', 'CIRUGIAS.registrarCirugia')->name('ShowRegistrarCirugia');


 Route::post('/registrarCirugia',[
  'uses' => 'cirugiasController@registrarCirugia',
  ])->name('registrarCirugia');

  Route::get('/listaDeCirugias', [
    'uses' => 'cirugiasController@listaDeCirugias',
  ])->name('listaDeCirugias');

  Route::get('/fichaCirugia/{id}',[
    'uses' => 'cirugiasController@fichaCirugia',
    ])->name('fichaCirugia');

  Route::patch('/fichaCirugia/{id}',[
    'uses' => 'cirugiasController@actualizarCirugia',
    ])->name('actualizarCirugia');

  Route::get('/implementosUsados/{id}',[
    'uses' => 'cirugiasController@showRegistarImplementos',
    ])->name('showRegistarImplementos');

  Route::post('/implementosUsados/{id}',[
    'uses' => 'cirugiasController@registrarImplementosAusar',
    ])->name('registarrImplementosAusar');


  Route::view('/index', 'CIRUGIAS.indexCirugias')->name('Cirugias');
});



  Route::group(['prefix' => 'BODEGA'], function () {

     Route::view('/index', 'BODEGA.indexBodega')->name('indexBodega');

     Route::group(['prefix' => 'MERMAS'], function () {

       Route::view('/registroDeMermas', 'BODEGA.registroDeMermas')->name('registroDeMermas');

     });

     Route::group(['prefix' => 'INGRESOS'], function () {

       Route::get('/ingresoDeArticulos',[
         'uses' => 'bodegaController@ShowFormularioArticulo',
         ])->name('ingresoDeArticulos');
       //
       // Route::post('/',[
       //   'uses' => 'bodegaController@buscarProducto',
       //   ])->name('buscarProducto');


       Route::post('/ingresoDeProductos',[
         'uses' => 'bodegaController@ingresarArticulo',
         ])->name('ingresarArticulo');

     });

     Route::group(['prefix' => 'INVENTARIO'], function () {

           Route::get('/ListadoDeArticulos',[
             'uses' => 'bodegaController@ListadoDeArticulos',
             ])->name('ListadoDeArticulos');

           Route::get('/actualizarExistencias/{id}',[
             'uses' => 'bodegaController@showActualizarExistencias',
             ])->name('showActualizarExistencias');

           Route::patch('/actualizarExistencias/{$id}',[
             'uses' => 'bodegaController@agrearExistencias',
             ])->name('agrearExistencias');
     });
     // Route::group(['prefix' => 'PRESTAMO'], function () {
     //   Route::view('/modificarCirugia', 'BODEGA.modificarCirugia')->name('modificarCirugia');    // });

   });
