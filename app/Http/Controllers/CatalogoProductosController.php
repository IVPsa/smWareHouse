<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CatalogoProductosController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function showCrearProducto()
    {
      $tipoConexion= TC_TIPO_CONEXION::all();
      $tipoImplante= TI_TIPO_IMPLANTE::all();
      $colorCoding= CLC_COLOR_CODING::all();

      return view('CATALOGO.nuevoProducto',compact('tipoConexion','tipoImplante','colorCoding'));

    }

    public function createProducto(Request $request)
    {
      $id = Auth::id();
      $crearProducto= PRO_PRODUCTOS::create([
        'PROD_NOMBRE'=>$request->input('nompreProducto'),
        'PROD_DESCRIPCION'=>$request->input('descProducto'),
        'PROD_N_ARTICULO'=>$request->input('nArticulo'),
        'PROD_DIAMETRO'=>$request->input('diametro'),
        'PROD_LONGITUD'=>$request->input('longitud'),
        'PROD_USU_COD'=>$id,
        'PROD_CLC_COD'=>$request->input('clc'),
        'PROD_TC_COD'=>$request->input('tpc'),
        'PROD_TI_COD'=>$request->input('tp'),
        'updated_at'=> Carbon::now(),
        'created_at'=> Carbon::now()
      ]);

      if (! $crearProducto) {
        return redirect()->route('catalogo')->with('error', "Hubo un problema al crear el producto.");
    }

    return redirect()->route('catalogo')->with('success', "El producto ha sido creado exitosamente.");

    }

    public function listaProductos(){

      $listaDeProductos= DB::table('PRO_PRODUCTOS')->paginate();

      return view('CATALOGO.listaProductos', compact('listaDeProductos'));

    }
}
