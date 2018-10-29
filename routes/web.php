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

Route::view('/lector', 'pruebaLector')->name('pruebaLector');

Route::group(['prefix'=>'CATALOGO'],function () {

       Route::view('/index', 'CATALOGO.indexCatalogo')->name('catalogo');
  //IMPLANTES
       Route::view('/eliminarProducto/{id}', 'CATALOGO.eliminarProducto')->name('eliminarProducto');
       Route::view('/ModificarProducto/{id}', 'CATALOGO.modificarProducto')->name('modificarProducto');

     // Route::view('/ListadoDeProductos', 'CATALOGO.listaProductos')->name('listaProductos');

       Route::get('/ListadoDeProductos', [
         'uses' => 'CatalogoProductosController@listaProductos',
       ])->name('listaProductos');

       Route::get('/buscarProducto', [
         'uses' => 'CatalogoProductosController@buscarProducto',
       ])->name('buscarProducto');

       Route::get('/fichaDeProducto/{id}', [
         'uses' => 'CatalogoProductosController@fichaDeProducto',
       ])->name('fichaDeProducto');

       Route::get('/fichaDePilar/{id}', [
         'uses' => 'CatalogoProductosController@fichaDePilar',
       ])->name('fichaDePilar');

       Route::get('/borrarPoducto/{id}', [
         'uses' => 'CatalogoProductosController@borrarPoducto',
       ])->name('borrarPoducto');

     // Route::view('/nuevoProducto', 'CATALOGO.nuevoProducto')->name('nuevoProducto');

       Route::get('/nuevoProducto', [
         'uses' => 'CatalogoProductosController@showCrearProducto',
       ])->name('nuevoProducto');

       Route::post('/nuevoProducto', [
         'uses' => 'CatalogoProductosController@createProducto',
         'as' => 'createProducto',
       ])->name('nuevoProducto');
  //FIN IMPLANTES

       Route::post('/nuevoProducto', [
         'uses' => 'CatalogoProductosController@createPilar',
       ])->name('createPilar');

});

Route::group(['prefix' => 'CIRUGIAS'], function () {

  Route::view('/registrarCirugia', 'CIRUGIAS.registrarCirugia')->name('ShowRegistrarCirugia');


  Route::post('/registrarCirugia',[
  'uses' => 'cirugiasController@registrarCirugia',
  ])->name('registrarCirugia');

  Route::get('/listaDeCirugias', [
    'uses' => 'cirugiasController@listaDeCirugias',
  ])->name('listaDeCirugias');

  Route::get('/buscador', [
    'uses' => 'cirugiasController@BuscadorDeCirugias',
  ])->name('buscador');

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
    ])->name('registrarImplementosAusar');

  Route::get('/eliminar/{id}',[
    'uses' => 'cirugiasController@quitarImplemento',
    ])->name('quitarImplemento');


  Route::get('/eliminarCirugia/{id}',[
    'uses' => 'cirugiasController@eliminarCirugia',
    ])->name('eliminarCirugia');

  Route::view('/index', 'CIRUGIAS.indexCirugias')->name('Cirugias');
});



Route::group(['prefix' => 'BODEGA'], function () {

  Route::view('/IndexBodega', 'BODEGA.indexBodega')->name('IndexBodega');

    Route::group(['prefix' => 'IMPLANTES'], function () {
      Route::get('/indexBodegaImplantes',[
        'uses' => 'bodegaController@indexBodegaImplantes',
        ])->name('IndexBodegaImplantes');

    });

    Route::group(['prefix' => 'PILARES'], function () {
      Route::view('/IndexBodegaPilares', 'PILARES.IndexPilares')->name('IndexBodegaPilares');
      Route::view('/actualizarExistenciasPilares', 'PILARES.BODEGA.actualizarExistenciasPilares')->name('actualizarExistenciasPilares');
      Route::view('/ingresoDePilaresPorCodProd', 'PILARES.BODEGA.ingresoDePilaresPorCodProd')->name('ingresoDePilaresPorCodProd');
      Route::view('/listaDePilaresUsados', 'PILARES.BODEGA.listaDePilaresUsados')->name('listaDePilaresUsados');
      Route::view('/fichaDePilar', 'PILARES.BODEGA.fichaDePilar')->name('fichaDePilarEnBodega');

      Route::get('/fichaDePilar/{id}',[
      'uses'=>'bodegaController@showFichaPilar',
        ])->name('fichaDePilarEnBodega');


      Route::get('/listaDePilaresEnBodega',[
      'uses'=>'bodegaController@listadoDePilares',
        ])->name('listaDePilaresEnBodega');

      Route::post('/ingresoDePilaresPorCodProd',[
        'uses' => 'bodegaController@ingresarPilares',
        ])->name('insertPilares');

    });

    Route::group(['prefix' => 'INGRESOS'], function () {

     Route::get('/ingresoDeArticulos',[
       'uses' => 'bodegaController@ShowFormularioArticulo',
       ])->name('ingresoDeArticulos');

     Route::get('/fichaDeArticulo/{id}',[
       'uses' => 'bodegaController@showFichaArticulo',
       ])->name('fichaDeArticulo');
     //
     // Route::post('/',[
     //   'uses' => 'bodegaController@buscarProducto',
     //   ])->name('buscarProducto');

     Route::get('/fichaPilar/{id}',[
       'uses' => 'stockPilaresController@fichaPilar',
       ])->name('fichaPilar');


     Route::post('/ingresoDeProductos',[
       'uses' => 'bodegaController@ingresarArticulo',
       ])->name('ingresarArticulo');

       Route::post('/ingresoDePilares',[
         'uses' => 'stockPilaresController@ingrearPilar',
         ])->name('ingresarPilar');

    });

    Route::group(['prefix' => 'INVENTARIO'], function () {

         Route::get('/ListadoDeArticulos',[
           'uses' => 'bodegaController@ListadoDeArticulos',
           ])->name('ListadoDeArticulos');


         Route::get('/actualizarExistencias/{id}',[
           'uses' => 'bodegaController@showActualizarExistencias',
           ])->name('showActualizarExistencias');

         Route::get('/agregarExistenciasPorCodigoDeProducto/{id}',[
           'uses' => 'bodegaController@agregarExistenciasPorCodigoDeProducto',
           ])->name('agregarExistenciasPorCodigoDeProducto');

         Route::patch('/actualizarExistencias/{id}',[
           'uses' => 'bodegaController@agrearExistencias',
           ])->name('agrearExistencias');

         Route::get('/ImplementosUtilizados',[
           'uses' => 'bodegaController@listadoDeImplementosUsados',
           ])->name('ImplementosUtilizados');

         Route::get('/BuscarImplementosUtilizados',[
           'uses' => 'bodegaController@buscarImplementos',
           ])->name('buscarImplementos');

         Route::get('/buscarArticulo',[
           'uses' => 'bodegaController@buscarArticulo',
           ])->name('buscarArticulo');


    });
   // Route::group(['prefix' => 'PRESTAMO'], function () {
   //   Route::view('/modificarCirugia', 'BODEGA.modificarCirugia')->name('modificarCirugia');    // });

});
