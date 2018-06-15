<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//ARTICULOS

Route::get('/ListaDeArticulos', 'SMapiController@ListadoDeArticulos');


Route::get('/FichaDeArticulo/{id}', 'SMapiController@FichaDeArticulo');


Route::post('/AgregarArticulo', 'SMapiController@AgregarArticulo');


Route::post('/ActualizarExistencias/{id}', 'SMapiController@ActualizarExistencias');


Route::get('/ListaGeneralDeImplantesUsados/{id}', 'SMapiController@ListaGeneralDeImplantesUsados');

Route::delete('/eliminarArticulo/{id}', 'SMapiController@eliminarArticulo');


//PRODUCTOS

Route::get('/ListaDeProducto', 'SMapiController@ListaDeProductos');


Route::get('/FichaDeProducto/{id}', 'SMapiController@FichaDeProducto');


Route::post('/CrearProducto', 'SMapiController@CrearProducto');

//Cirugias

Route::get('ListaDeCirugias', 'SMapiController@ListaDeCirugias');

Route::post('CrearCirugia', 'SMapiController@CrearCirugia');

Route::get('fichaCirugia/{$id}', 'SMapiController@FichaDeCirugia');


Route::get('ImplementosUsados/{$id}', 'SMapiController@FichaDeImplementosUsados');

Route::post('ImplementosUsados/{$id}', 'SMapiController@agregarImplemento');
