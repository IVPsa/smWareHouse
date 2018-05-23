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
        'PROD_UDI_01'=>$request->input('udi01'),
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

      $listaDeProductos=
      DB::table('PRO_PRODUCTOS')->paginate();
      // $tipoConexion;
      // $tipoImplante;
      // $codColor;

      // DB::table('PRO_PRODUCTOS')
      //       ->join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD ', '=', 'PRODUCTOS.PROD_CLC_COD')
      //       ->join('PRO_PRODUCTOS', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRODUCTOS.PROD_TI_COD')
      //       // ->join('PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'PRO_PRODUCTOS.PROD_COD')
      //       ->select('PRO_PRODUCTOS.PROD_COD', 'CLC_COLOR_CODING.CLC_COLOR')
      //       ->get();

      return view('CATALOGO.listaProductos', compact('listaDeProductos'));

    }

    public function fichaDeProducto($id){


      $producto = PRO_PRODUCTOS::find($id);

      $clcid= PRO_PRODUCTOS::where('PROD_COD',$id)->value('PROD_CLC_COD');
      $color=DB::table('CLC_COLOR_CODING')->select('CLC_COLOR')->where('CLC_COD', $clcid)->value('CLC_COLOR');

      $tpiId= PRO_PRODUCTOS::where('PROD_COD',$id)->value('PROD_TI_COD');
      $tipoImplante=DB::table('TI_TIPO_IMPLANTE')->select('TI_CLASE')->where('TI_COD', $tpiId)->value('TI_DES');

      $tpcId= PRO_PRODUCTOS::where('PROD_COD',$id)->value('PROD_TC_COD');
      $tipoConexion=TC_TIPO_CONEXION::where('TC_COD',$tpcId)->value('TC_DES');
      $tipoConexionDiametro=TC_TIPO_CONEXION::where('TC_COD',$tpcId)->value('TC_DIAMETRO');



      return view('CATALOGO.fichaProducto', compact('producto','color', 'tipoImplante','tipoConexion','tipoConexionDiametro'));

    }
}
