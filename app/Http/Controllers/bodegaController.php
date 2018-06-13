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


      if ($codReferencia==null){

          return redirect()->route('ingresoDeArticulos')->with('error', "El UDI01 no ha sido registrado, por favor registre el nuevo producto en catalogo para ingresar la existencia .");
      }


        $udiArt=$request->input('udi');
        $Revisarlote=ART_ARTICULOS::where('ART_UDI',$udiArt)->value('ART_LOTE');
        $lote=$request->input('lote');

        if($Revisarlote==$lote){


            $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_UDI', $udiArt)->value('ART_CANT');

            $nuevasExistencias=$request->input('cantidad');

            $valorFinal=$valorActual+$nuevasExistencias;

            $ingresarArticulo=ART_ARTICULOS::where('ART_LOTE',$lote)->update([

              'ART_CANT'=>$valorFinal
            ]);
        }
        else{

            $ingresarArticulo= ART_ARTICULOS::create([
              'ART_UDI'=>$request->input('udi'),
              'ART_PROD_COD'=>$codReferencia,
              'ART_FECHA_EXP'=>$request->input('fechaExp'),
              'ART_LOTE'=>$lote,
              'ART_CANT'=>$request->input('cantidad'),
              'updated_at'=> Carbon::now(),
              'created_at'=> Carbon::now()
            ]);

            if (!$ingresarArticulo) {
              return redirect()->route('indexBodega')->with('error', "Hubo un problema al ingresar la existencia.");
            }

        }

        return redirect()->route('indexBodega')->with('success', "Se ha registrado la existencia exitosamente.");

    }

    public function ListadoDeArticulos(){

      // $listadoDeArticulos=DB::table('ART_ARTICULOS')->paginate();

      $listadoDeArticulos = DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
      ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
      ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')


      ->select(
      'PRO_PRODUCTOS.PROD_UDI_01',
      'PRO_PRODUCTOS.PROD_NOMBRE',
      'PRO_PRODUCTOS.PROD_LONGITUD',
      'PRO_PRODUCTOS.PROD_DIAMETRO',
      'TC_TIPO_CONEXION.TC_DES',
      'TI_TIPO_IMPLANTE.TI_CLASE',
      'CLC_COLOR_CODING.CLC_COLOR',
      'ART_ARTICULOS.ART_COD',
      'ART_ARTICULOS.ART_UDI',
      'ART_ARTICULOS.ART_LOTE',
      'ART_ARTICULOS.ART_FECHA_EXP',
      'ART_ARTICULOS.ART_CANT',
      'ART_ARTICULOS.ART_PROD_COD'
      )
      ->orderBy('PRO_PRODUCTOS.PROD_NOMBRE', 'DESC')
      ->orderBy('CLC_COLOR_CODING.CLC_COLOR', 'DESC')
      ->orderby('PRO_PRODUCTOS.PROD_DIAMETRO', 'DESC')
      ->orderby('PRO_PRODUCTOS.PROD_LONGITUD', 'DESC')
      ->paginate();




      return view('BODEGA.listadoDeArticulos',compact('listadoDeArticulos') );
    }

    public function showActualizarExistencias($id){

      $Articulo = ART_ARTICULOS::find($id);
      $prodCod = ART_ARTICULOS::where('ART_COD',$id)->value('ART_PROD_COD');
      $udiProd=PRO_PRODUCTOS::where('PROD_COD',$prodCod)->value('PROD_UDI_01');


      return view('BODEGA.actualizarExistencias',compact('Articulo', 'udiProd', 'prodCod') );
    }

    public function agrearExistencias(Request $request, $id){

      $ingresarExistencias= ART_ARTICULOS::where('ART_COD',$id)->update([

        'ART_CANT'=>$request->input('cantidad')
      ]);

      if (!$ingresarExistencias) {
        return redirect()->route('ListadoDeArticulos')->with('error', "Hubo un problema al actualizar el Stock.");
      }

        return redirect()->route('ListadoDeArticulos')->with('success', "Stock actualizado correctamente.");

    }

    public function listadoDeImplementosUsados(){


      $listaDeUsados = DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')
      ->Join('ART_ARTICULOS', 'ART_ARTICULOS.ART_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_ART_COD')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')


      ->select(
        'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_FECHA_DE_USO',
        'ART_ARTICULOS.ART_LOTE',
        'ART_ARTICULOS.ART_FECHA_EXP',
        'ART_ARTICULOS.ART_CANT',
        'ART_ARTICULOS.ART_PROD_COD',
        'PRO_PRODUCTOS.PROD_NOMBRE',
        'PRO_PRODUCTOS.PROD_DESCRIPCION',
        'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_CIR_COD'

        )->paginate();


        return view('BODEGA.listadoDeImplementosUsados', compact('listaDeUsados'));
    }

    public function IndexBodega(){

            $condicional= DB::table('ART_ARTICULOS')
            ->select('ART_CANT')->where('ART_CANT', '<=', '5')->value('ART_CANT');


            $stockCritico=DB::table('ART_ARTICULOS')

            ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
            ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
            ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
            ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')


            ->select(
            'PRO_PRODUCTOS.PROD_UDI_01',
            'PRO_PRODUCTOS.PROD_NOMBRE',
            'PRO_PRODUCTOS.PROD_LONGITUD',
            'PRO_PRODUCTOS.PROD_DIAMETRO',
            'TC_TIPO_CONEXION.TC_DES',
            'TI_TIPO_IMPLANTE.TI_CLASE',
            'CLC_COLOR_CODING.CLC_COLOR',
            'ART_ARTICULOS.ART_COD',
            'ART_ARTICULOS.ART_UDI',
            'ART_ARTICULOS.ART_LOTE',
            'ART_ARTICULOS.ART_FECHA_EXP',
            'ART_ARTICULOS.ART_CANT',
            'ART_ARTICULOS.ART_PROD_COD'
            )
            ->orderBy('PRO_PRODUCTOS.PROD_NOMBRE', 'DESC')
            ->orderby('PRO_PRODUCTOS.PROD_DIAMETRO', 'DESC')
            ->orderby('PRO_PRODUCTOS.PROD_LONGITUD', 'DESC')
            ->orderBy('CLC_COLOR_CODING.CLC_COLOR', 'DESC')
            ->where('ART_CANT', '<=', '5')->paginate();

            return view('BODEGA.indexBodega', compact('stockCritico', 'condicional'));
    }

    public function buscarImplementos(Request $request){

      $desde=$request->input('fechaDesde');
      $hasta=$request->input('fechaHasta');


      $listaDeUsados=DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')
              ->Join('ART_ARTICULOS', 'ART_ARTICULOS.ART_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_ART_COD')
              ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')


              ->select(
                'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_FECHA_DE_USO',
                'ART_ARTICULOS.ART_LOTE',
                'ART_ARTICULOS.ART_FECHA_EXP',
                'ART_ARTICULOS.ART_CANT',
                'ART_ARTICULOS.ART_PROD_COD',
                'PRO_PRODUCTOS.PROD_NOMBRE',
                'PRO_PRODUCTOS.PROD_DESCRIPCION',
                'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_CIR_COD',
                'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_CIR_COD'

                )->where('IUC_FECHA_DE_USO', [$desde, $hasta] )->paginate();

                return view('BODEGA.listadoDeImplementosUsados', compact('listaDeUsados'));

    }

    public function showFichaArticulo($id){

        $Articulo = ART_ARTICULOS::find($id);
        $prodCod = ART_ARTICULOS::where('ART_COD',$id)->value('ART_PROD_COD');
        $udiProd=PRO_PRODUCTOS::where('PROD_COD',$prodCod)->value('PROD_UDI_01');



        return view('BODEGA.fichaDeArticulo', compact('Articulo','prodCod','udiProd'));

    }

}
