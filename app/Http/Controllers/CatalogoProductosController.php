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

      $udi01=$request->input('udi01');
      $buscarUDI= PRO_PRODUCTOS::where('PROD_UDI_01',$udi01)->get();

      if($buscarUDI=="[]"){
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


          return redirect()->route('catalogo')->with('success', "Se ha ingresado el articulo exitosamente.");

      }

      else{
        return redirect()->route('catalogo')->with('error', "El udi01 ya esta registrado.");
      }

      if (! $crearProducto) {
        return redirect()->route('catalogo')->with('error', "Hubo un problema al crear ingresado el articulo.");
      }



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
      $color=DB::table('CLC_COLOR_CODING')->select('CLC_COLOR','CLC_COD')->get();

      $tipoImplante=DB::table('TI_TIPO_IMPLANTE')->select('TI_COD','TI_CLASE')->get();

      // $tipoConexion=TC_TIPO_CONEXION::where('TC_COD',$tpcId)->all();

      return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));

    }

    public function buscarProducto(Request $request){

      $condicion=$request->input('condicion');


      $color=DB::table('CLC_COLOR_CODING')->select('CLC_COLOR','CLC_COD')->get();
      $tipoImplante=DB::table('TI_TIPO_IMPLANTE')->select('TI_COD','TI_CLASE')->get();

      switch ($condicion) {
        case 'DIAMETRO':
          $diametro= $request->input('diametro');
          $listaDeProductos  =DB::table('PRO_PRODUCTOS')->where('PROD_DIAMETRO', $diametro )->paginate();
          return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));
        break;

        case 'LARGO':
          $largo= $request->input('largo');
          $listaDeProductos  =DB::table('PRO_PRODUCTOS')->where('PROD_LONGITUD', $largo )->paginate();
          return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));
        break;

        case 'TIPO':
          $TpImplante= $request->input('tipoImplante');
          $listaDeProductos  =DB::table('PRO_PRODUCTOS')->where('PROD_TI_COD', $TpImplante )->paginate();
          return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));
        break;

        case 'COLOR':
          $codigoColor= $request->input('color');
          $listaDeProductos  =DB::table('PRO_PRODUCTOS')->where('PROD_CLC_COD', $codigoColor )->paginate();
          return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));
        break;

        case 'UDI':
          $udi01= $request->input('udi01');
          $listaDeProductos  =DB::table('PRO_PRODUCTOS')->where('PROD_UDI_01', $udi01 )->paginate();
        return view('CATALOGO.listaProductos', compact('listaDeProductos' ,'tipoImplante','color'));
        break;

        default:
          // code...
          break;
      }

    }

    public function borrarPoducto( $id){

      $eliminar= PRO_PRODUCTOS::where('PROD_COD',$id)->delete();


      if (!$eliminar) {
        return redirect()->route('listaProductos')->with('error', "Hubo un problema al crear borrar el articulo.");
      }

        return redirect()->route('listaProductos')->with('success', "Se ha eliminado el articulo exitosamente.");

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

      // $conteoGeneral=DB::table('PRO_PRODUCTOS')->select('PROD_COD')->count();

      $conteoGeneral = DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')

      ->select('PRO_PRODUCTOS.PROD_UDI_01',
      'ART_ARTICULOS.ART_COD',
      'ART_ARTICULOS.ART_UDI',
      'ART_ARTICULOS.ART_LOTE',
      'ART_ARTICULOS.ART_FECHA_EXP',
      'ART_ARTICULOS.ART_CANT',
      'ART_ARTICULOS.ART_PROD_COD'
      )->where('ART_ARTICULOS.ART_PROD_COD',$id)->sum('ART_ARTICULOS.ART_CANT');

      $act=DB::table('ART_ARTICULOS')->select('ART_COD')->value('ART_COD');
      //  $cantProd= DB::table('PRO_PRODUCTOS')->select('PROD_COD')->count()  ;
      // $datosDelImplante = DB::table('PRO_PRODUCTOS')
      // ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PROD_PRODUCTOS.PROD_CLC_COD')
      // ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PROD_PRODUCTOS.PROD_TI_COD')
      // ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PROD_PRODUCTOS.PROD_TC_COD')
      //
      // ->select('CLC_COLOR_CODING.CLC_COLOR',
      // 'TI_TIPO_IMPLANTE.TI_DES',
      // 'TI_TIPO_IMPLANTE.TI_CLASE',
      // 'TC_TIPO_CONEXION.TC_DES',
      // 'TC_TIPO_CONEXION.TC_DIAMETRO',
      // 'PROD_PRODUCTOS.PROD_COD',
      // 'PROD_PRODUCTOS.PROD_UDI_01',
      // 'PROD_PRODUCTOS.PROD_N_ARTICULO',
      // 'PROD_PRODUCTOS.PROD_NOMBRE',
      // 'PROD_PRODUCTOS.PROD_DIAMETRO',
      // 'PROD_PRODUCTOS.PROD_LONGITUD',
      // 'PROD_PRODUCTOS.PROD_DESCRIPCION'
      // )->where('PRO_PRODUCTOS.PROD_COD', $id)->value('PROD_PRODUCTOS.PROD_DESCRIPCION');
      // dd($datosDelImplante);





      return view('CATALOGO.fichaProducto', compact('producto','color', 'tipoImplante','tipoConexion','tipoConexionDiametro','datosDelImplante','conteoGeneral','act'));

    }


}
