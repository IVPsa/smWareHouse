<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\ART_ARTICULOS;
use App\PL_PILARES;
use App\PB_PILARES_EN_BODEGA;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


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
              return redirect()->route('IndexBodegaImplantes')->with('error', "Hubo un problema al ingresar la existencia.");
            }

        }

        return redirect()->route('IndexBodegaImplantes')->with('success', "Se ha registrado la existencia exitosamente.");

    }

    public function ingresarPilares(Request $request){
      $udi01=$request->input('udi01');
      $codReferencia=PL_PILARES::where('PL_UDI01',$udi01)->value('PL_COD');


      if ($codReferencia==null){

          return redirect()->route('ingresoDePilaresPorCodProd')->with('error', "El UDI01 no ha sido registrado, por favor registre el nuevo producto en catalogo para ingresar la existencia .");
      }


        $udiArt=$request->input('udi');
        $Revisarlote=PB_PILARES_EN_BODEGA::where('PB_UDI_COMPLETO',$udiArt)->value('PB_LOTE');
        $lote=$request->input('lote');

        if($Revisarlote==$lote){


            $valorActual=DB::table('PB_PILARES_EN_BODEGA')->select('PB_CANT')->where('PB_UDI_COMPLETO', $udiArt)->value('PB_CANT');

            $nuevasExistencias=$request->input('cantidad');

            $valorFinal=$valorActual+$nuevasExistencias;

            $ingresarArticulo=PB_PILARES_EN_BODEGA::where('PB_LOTE',$lote)->update([

              'PB_CANT'=>$valorFinal
            ]);
        }
        else{

            $ingresarArticulo= PB_PILARES_EN_BODEGA::create([
              'PB_UDI_COMPLETO'=>$request->input('udi'),
              'PB_LOTE'=>$lote,
              'PB_PL_COD'=>$codReferencia,
              'PB_CANT'=>$request->input('cantidad'),
              'updated_at'=> Carbon::now(),
              'created_at'=> Carbon::now()
            ]);

            if (!$ingresarArticulo) {
              return redirect()->route('IndexBodegaPilares')->with('error', "Hubo un problema al ingresar la existencia.");
            }

        }

        return redirect()->route('IndexBodegaPilares')->with('success', "Se ha registrado la existencia exitosamente.");

    }

    public function ListadoDeArticulos(){
      $color=DB::table('CLC_COLOR_CODING')->select('CLC_COLOR','CLC_COD')->get();
      $tipoImplante=DB::table('TI_TIPO_IMPLANTE')->select('TI_COD','TI_CLASE')->get();
      // $listadoDeArticulos=DB::table('ART_ARTICULOS')->paginate();
      $condicion='';
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




      return view('BODEGA.listadoDeArticulos',compact('listadoDeArticulos','color','tipoImplante','condicion') );
    }

    public function ListadoDePilares(){
        $listadoDePilares = DB::table('PB_PILARES_EN_BODEGA')
        ->Join('PL_PILARES', 'PL_PILARES.PL_COD', '=', 'PB_PILARES_EN_BODEGA.PB_PL_COD')
        ->Join('TP_TIPO_PILAR', 'TP_TIPO_PILAR.TP_COD', '=', 'PL_PILARES.PL_TP_COD')
        ->select(
        'PL_COD',
        'PL_PILARES.PL_NOMBRE',
        'TP_TIPO_PILAR.TP_DESC',
        'PB_PILARES_EN_BODEGA.PB_COD',
        'PB_PILARES_EN_BODEGA.PB_CANT',
        'PB_PILARES_EN_BODEGA.PB_LOTE',
        'PB_PILARES_EN_BODEGA.PB_UDI_COMPLETO')

        ->paginate();

        return view('PILARES.BODEGA.listaDePilaresEnBodega',compact('listadoDePilares'));
    }

    public function showActualizarExistencias($id){

      $Articulo = ART_ARTICULOS::find($id);
      $prodCod = ART_ARTICULOS::where('ART_COD',$id)->value('ART_PROD_COD');
      $udiProd=PRO_PRODUCTOS::where('PROD_COD',$prodCod)->value('PROD_UDI_01');


      return view('BODEGA.actualizarExistencias',compact('Articulo', 'udiProd', 'prodCod') );
    }

    public function agregarExistenciasPorCodigoDeProducto($id){

      $udi01=PRO_PRODUCTOS::where('PROD_COD',$id)->value('PROD_UDI_01');


      return view('BODEGA.ingresoDeArticulosPorCodProd',compact('udi01') );
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

    public function indexBodegaImplantes(){

            // $condicional= DB::table('ART_ARTICULOS')
            // ->select('ART_CANT')->where('ART_CANT', '<=', '5')->distinct('ART_PROD_COD')->value('ART_CANT');


            // $stockCritico=DB::table('ART_ARTICULOS')
            //
            // ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
            // ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
            // ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
            // ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')
            //
            //
            // ->select(
            // 'PRO_PRODUCTOS.PROD_COD',
            // 'PRO_PRODUCTOS.PROD_UDI_01',
            // 'PRO_PRODUCTOS.PROD_NOMBRE',
            // 'PRO_PRODUCTOS.PROD_LONGITUD',
            // 'PRO_PRODUCTOS.PROD_DIAMETRO',
            // 'TC_TIPO_CONEXION.TC_DES',
            // 'TI_TIPO_IMPLANTE.TI_CLASE',
            // 'CLC_COLOR_CODING.CLC_COLOR',
            // 'ART_ARTICULOS.ART_COD',
            // 'ART_ARTICULOS.ART_UDI',
            // 'ART_ARTICULOS.ART_LOTE',
            // 'ART_ARTICULOS.ART_FECHA_EXP',
            // 'ART_ARTICULOS.ART_CANT',
            // 'ART_ARTICULOS.ART_PROD_COD'
            // )
            // ->orderBy('PRO_PRODUCTOS.PROD_NOMBRE', 'DESC')
            // ->orderby('PRO_PRODUCTOS.PROD_DIAMETRO', 'DESC')
            // ->orderby('PRO_PRODUCTOS.PROD_LONGITUD', 'DESC')
            // ->orderBy('CLC_COLOR_CODING.CLC_COLOR', 'DESC')
            //
            // ->where('ART_CANT', '<=', '5')
            // ->get();

            $productos=DB::table('PRO_PRODUCTOS')
            ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
            ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
            ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')
            ->orderBy('CLC_COLOR_CODING.CLC_COLOR', 'DESC')
            ->orderby('PRO_PRODUCTOS.PROD_LONGITUD', 'DESC')
            ->orderby('PRO_PRODUCTOS.PROD_DIAMETRO', 'DESC')
            ->orderBy('PRO_PRODUCTOS.PROD_COD', 'ASC')
            ->orderBy('PRO_PRODUCTOS.PROD_NOMBRE', 'DESC')
            ->get();

            return view('BODEGA.indexBodegaImplantes', compact('stockCritico', 'condicional','conteoGeneral','productos'));
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

    public function showFichaPilar($id){

      $pilar = PB_PILARES_EN_BODEGA::find($id);




      return view('PILARES.BODEGA.fichaDePilares', compact('pilar'));
    }

    public function buscarArticulo(Request $request){
      $condicion=$request->input('condicion');

      $color=DB::table('CLC_COLOR_CODING')->select('CLC_COLOR','CLC_COD')->get();
      $tipoImplante=DB::table('TI_TIPO_IMPLANTE')->select('TI_COD','TI_CLASE')->get();

        switch ($condicion) {
          case 'LOTE':
            $lote= $request->input('lote');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')

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
            ->where('ART_LOTE', $lote )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'fechaExp':
            $fechaExp= $request->input('FechaExp');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('ART_FECHA_EXP', $fechaExp )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'DIAMETRO':
            $diametro= $request->input('diametro');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('PRO_PRODUCTOS.PROD_DIAMETRO', $diametro )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'LARGO':
            $largo= $request->input('largo');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('PRO_PRODUCTOS.PROD_LONGITUD', $largo )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'TIPO':
            $TpImplante= $request->input('tipoImplante');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('PRO_PRODUCTOS.PROD_TI_COD', $TpImplante )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'COLOR':
            $codigoColor= $request->input('color');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('PRO_PRODUCTOS.PROD_CLC_COD', $codigoColor )->get();

            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;

          case 'UDI':
            $udi01= $request->input('udi01');
            $listadoDeArticulos  =DB::table('ART_ARTICULOS')
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
            ->where('PROD_UDI_01',$udi01 )->get();
            return view('BODEGA.listadoDeArticulos', compact('listadoDeArticulos' ,'tipoImplante','color','condicion'));
          break;


          default:
            // code...
          break;
        }
    }

}
