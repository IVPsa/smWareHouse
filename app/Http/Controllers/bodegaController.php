<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\ART_ARTICULOS;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class bodegaController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function ShowFormularioArticulo(){


      return view('BODEGA.ingresoDeArticulos' );
    }

    public function ingresarArticulo(Request $request){
      $udi01=$request->input('udi01');

      $codReferencia=PRO_PRODUCTOS::where('PROD_UDI_01',$udi01)->value('PROD_COD');

      $ingresarArticulo= ART_ARTICULOS::create([
        'ART_UDI'=>$request->input('udi'),
        'ART_PROD_COD'=>$codReferencia,
        'ART_FECHA_EXP'=>$request->input('fechaExp'),
        'ART_LOTE'=>$request->input('lote'),
        'ART_CANT'=>$request->input('cantidad'),
        'updated_at'=> Carbon::now(),
        'created_at'=> Carbon::now()
      ]);

      if (!$ingresarArticulo) {
        return redirect()->route('indexBodega')->with('error', "Hubo un problema al crear el producto.");
      }

        return redirect()->route('indexBodega')->with('success', "El producto ha sido creado exitosamente.");

    }
    public function ListadoDeArticulos(){

      $listadoDeArticulos=DB::table('ART_ARTICULOS')->paginate();

      return view('BODEGA.listadoDeArticulos',compact('listadoDeArticulos') );
    }
    //
    // public function buscarProducto(Request $request){
    //   $id=$request->input('udi01');
    //
    //   $udiRerefencia=PRO_PRODUCTOS::where('PROD_UDI_01',$id)->value('PROD_COD')
    //   // dd($udiRerefencia);
    //
    //   return view('BODEGA.ingresoDeProductos', compact('udiRerefencia') );
    //
    // }

}
