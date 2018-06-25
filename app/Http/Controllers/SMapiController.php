<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\CIR_CIRUGIA;
use App\PD_PIEZAS_DENTALES;
use App\ART_ARTICULOS;
use App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS;
use App\User;
use App\http\Resources\ArticulosApi;
use App\http\Resources\ProductosApi;
use App\http\Resources\CirugiasApi;
use App\http\Resources\colorCodingApi;
use App\http\Resources\TipoConexionApi;
use App\http\Resources\TipoImplanteApi;
use App\http\Resources\IucApi;



use Illuminate\Http\Resources\Json\JsonResource;


class SMapiController extends Controller
{

//INICIO API ART_ARTICULOS
  public function ListadoDeArticulos(){

    $listadoDeArticulos = ART_ARTICULOS::all();

    return ArticulosApi::collection($listadoDeArticulos);

  }

  public function FichaDeArticulo($id){

    $Articulo = ART_ARTICULOS::find($id);
        return response()->json($Articulo, 200);

  }

  public function AgregarArticulo(Request $request){

    $udi01=$request->input('PROD_UDI_01');
    //Conseguir este dato por alguna otra forma
    $codReferencia=PRO_PRODUCTOS::where('PROD_UDI_01',$udi01)->value('PROD_COD');

    if ($codReferencia==null){
      $error='ERROR EL UDI01 NO HA SIDO REGISTRADO';
      return response()->json($error,406);

    }
      $udiArt=$request->input('ART_UDI');
      $Revisarlote=ART_ARTICULOS::where('ART_UDI',$udiArt)->value('ART_LOTE');
      $lote=$request->input('ART_LOTE');
      if($Revisarlote==$lote){


          $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_UDI', $udiArt)->value('ART_CANT');

          $nuevasExistencias=$request->input('ART_CANT');

          $valorFinal=$valorActual+$nuevasExistencias;

          $ingresarArticulo=ART_ARTICULOS::where('ART_LOTE',$lote)->update([

            'ART_CANT'=>$valorFinal
          ]);


            return response()->json ($ingresarArticulo,200);
      }

      else{

          $ingresarArticulo= ART_ARTICULOS::create([
            'ART_UDI'=>$request->input('ART_UDI'),
            'ART_PROD_COD'=>$codReferencia,
            'ART_FECHA_EXP'=>$request->input('ART_FECHA_EXP'),
            'ART_LOTE'=>$request->input('ART_LOTE'),
            'ART_CANT'=>$request->input('ART_CANT'),
            'updated_at'=> Carbon::now(),
            'created_at'=> Carbon::now()
          ]);
           if(!$ingresarArticulo){
             return response("error")->json(422);
           }

           return response()->json ($ingresarArticulo,200);
    }

  }

  public function ActualizarExistencias($id, Request $request){
     $CANTIDAD=$request->input('ART_CANT');

     $Articulo= ART_ARTICULOS::where('ART_COD',$id)->update([

       'ART_CANT'=>$CANTIDAD
     ]);


    return response()->json ($Articulo,200);

  }

  public function eliminarArticulo($id){

    $Articulo= ART_ARTICULOS::where('ART_COD',$id)->delete();

    return response()->json ($Articulo,200);


  }

//FIN API ART_ARTICULOS

//INICIO API PRO_PRODUCTOS

  public function ListaDeProductos(){
    $listadoDeProductos = PRO_PRODUCTOS::all();

    return ProductosApi::collection($listadoDeProductos);
  }

  public function FichaDeProducto($id){


    $fichaProducto = DB::table('PRO_PRODUCTOS')
    ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
    ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
    ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')
    ->select(
    'PRO_PRODUCTOS.PROD_COD',
    'PRO_PRODUCTOS.PROD_NOMBRE',
    'PRO_PRODUCTOS.PROD_DESCRIPCION',
    'PRO_PRODUCTOS.PROD_UDI_01',
    'PRO_PRODUCTOS.PROD_N_ARTICULO',
    'PRO_PRODUCTOS.PROD_LONGITUD',
    'PRO_PRODUCTOS.PROD_DIAMETRO',
    'TC_TIPO_CONEXION.TC_DES',
    'TI_TIPO_IMPLANTE.TI_CLASE',
    'CLC_COLOR_CODING.CLC_COLOR'

    )->where('PROD_COD',$id)->get();

    $conteoGeneral = DB::table('ART_ARTICULOS')
    ->select(
    'ART_ARTICULOS.ART_CANT'
    )->where('ART_ARTICULOS.ART_PROD_COD',$id)->sum('ART_ARTICULOS.ART_CANT');

    $mensaje='EXISTENCIAS EN BODEGA='.$conteoGeneral;

    return response()->json ([$fichaProducto,$mensaje],
    200);
  }

  public function CrearProducto(Request $request){

    $udi01=$request->input('PROD_UDI_01');

    $buscarUDI= PRO_PRODUCTOS::where('PROD_UDI_01',$udi01)->get();

    if($buscarUDI=="[]"){

      $ingresarNuevoProducto=PRO_PRODUCTOS::create([
        'PROD_NOMBRE'=>$request->input('PROD_NOMBRE'),
        'PROD_DESCRIPCION'=>$request->input('PROD_DESCRIPCION'),
        'PROD_N_ARTICULO'=>$request->input('PROD_N_ARTICULO'),
        'PROD_DIAMETRO'=>$request->input('PROD_DIAMETRO'),
        'PROD_LONGITUD'=>$request->input('PROD_LONGITUD'),
        'PROD_USU_COD'=>1,
        'PROD_UDI_01'=>$request->input('PROD_UDI_01'),
        'PROD_CLC_COD'=>$request->input('PROD_CLC_COD'),
        'PROD_TC_COD'=>$request->input('PROD_TC_COD'),
        'PROD_TI_COD'=>$request->input('PROD_TI_COD'),

      ]);
      return response()->json($ingresarNuevoProducto,200);
    }

    else{
      return response()->json(406);
    }


  }
//FIN API PRO_PRODUCTOS

//INICIO API CIRUGIAS

  public function ListaDeCirugias(){
    $listadoDeCirugias = CIR_CIRUGIA::all();

    return CirugiasApi::collection($listadoDeCirugias);
  }

  public function CrearCirugia(Request $request){

      $crearCirugia = CIR_CIRUGIA::create([
            'CIR_NOMBRE_PACIENTE'=>$request->input('CIR_NOMBRE_PACIENTE'),
            'CIR_RUT_PACIENTE'=>$request->input('CIR_RUT_PACIENTE'),
            'CIR_FECHA'=>$request->input('CIR_FECHA'),
            'CIR_DESCRIPCION'=>$request->input('CIR_DESCRIPCION'),
            'CIR_ESTADO'=>$request->input('CIR_ESTADO'),

          ]);
          return response()->json($crearCirugia,200);
  }

  public function fichaCirugia($id){


    $fichaCirugia = DB::table('CIR_CIRUGIA')->select()->where('CIR_COD',$id)->get();

    return CirugiasApi::collection($fichaCirugia);
  }

//FIN API CIRUGIAS

//INICIO API IMPLEMENTOS USADOS
  public function agregarImplemento(Request $request){

    $idCirugia=$request->input('IUC_CIR_COD');
    $fechaCirugia=DB::table('CIR_CIRUGIA')->select('CIR_FECHA')->where('CIR_COD',$idCirugia)->value('CIR_FECHA');

    $diente=$request->input('IUC_PD_COD');


    $idArt=$request->input('IUC_ART_COD');

    $comprobarDienteRepetido=DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')->where('IUC_PD_COD', $diente)->count();

    if ($comprobarDienteRepetido == 1){
        return response()->json(406);
    }
    else{

      $registarImplementoUsado= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create([
        'IUC_ART_COD'=>$idArt,
        'IUC_CIR_COD'=> $idCirugia,
        'IUC_PD_COD'=>$diente,
        'IUC_FECHA_DE_USO'=> $fechaCirugia,
        'updated_at'=> Carbon::now(),
        'created_at'=> Carbon::now()
      ]);
    }


      $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_COD', $idArt)->value('ART_CANT');


      $valorFinal=$valorActual-1;


      $actualizarRegistroEnBodega=ART_ARTICULOS::where('ART_COD',$idArt)->update([

        'ART_CANT'=>$valorFinal
      ]);

      return response()->json(200);

  }

  public function FichaImplementosUsados($id){

    $listaImplementos = DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')
    ->Join('CIR_CIRUGIA', 'CIR_CIRUGIA.CIR_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_CIR_COD')
    ->Join('ART_ARTICULOS', 'ART_ARTICULOS.ART_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_ART_COD')
    ->Join('PD_PIEZAS_DENTALES', 'PD_PIEZAS_DENTALES.PD_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_PD_COD')
    ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
    ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')
    ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
    ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')

    ->select(
    'PD_PIEZAS_DENTALES.PD_N_DIENTE',
    'PD_PIEZAS_DENTALES.PD_NOMBRE',
    'PRO_PRODUCTOS.PROD_COD',
    'PRO_PRODUCTOS.PROD_NOMBRE',
    'PRO_PRODUCTOS.PROD_DIAMETRO',
    'PRO_PRODUCTOS.PROD_LONGITUD',
    'ART_ARTICULOS.ART_COD',
    'ART_ARTICULOS.ART_UDI',
    'ART_ARTICULOS.ART_LOTE',
    'ART_ARTICULOS.ART_FECHA_EXP',
    'ART_ARTICULOS.ART_CANT',
    'TC_TIPO_CONEXION.TC_DES',
    'TI_TIPO_IMPLANTE.TI_CLASE',
    'CLC_COLOR_CODING.CLC_COLOR'

    )->where('IUC_CIR_COD', '=', $id)->get();

      return IucApi::collection($listaImplementos);
  }

  public function QuitarImplementoImplementos( Request $request ){

    $id=$request->input('IUC_ART_COD');
    $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_COD', $id)->value('ART_CANT');

    $valorFinal=$valorActual+1;

    $actualizarRegistroEnBodega=ART_ARTICULOS::where('ART_COD',$id)->update([

      'ART_CANT'=>$valorFinal
    ]);

    $quitarImplemento= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::where('IUC_ART_COD',$id)->delete();

    return response()->json(200);
  }

  public function ListaGeneralDeImplantesUsados(){
    $listaDeUsados = DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')
    ->Join('ART_ARTICULOS', 'ART_ARTICULOS.ART_COD', '=', 'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_ART_COD')
    ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
    ->Join('CIR_CIRUGIA', 'CIR_CIRUGIA.CIR_COD', '=', 'CIR_CIRUGIA.CIR_COD')

    ->select(
      'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_FECHA_DE_USO',
      'ART_ARTICULOS.ART_LOTE',
      'ART_ARTICULOS.ART_FECHA_EXP',
      'ART_ARTICULOS.ART_CANT',
      'ART_ARTICULOS.ART_PROD_COD',
      'PRO_PRODUCTOS.PROD_NOMBRE',
      'PRO_PRODUCTOS.PROD_DESCRIPCION',
      'IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS.IUC_CIR_COD'

    )->get();

    return IucApi::collection($listaDeUsados);
  }
//FIN API IMPLEMENTOS USADOS


  public function colorCoding(){
    $colores = CLC_COLOR_CODING::all();

    return colorCodingApi::collection($colores);
  }

  public function tipoImplante(){
    $tpImplante = TI_TIPO_IMPLANTE::all();

    return TipoImplanteApi::collection($tpImplante);
  }

  public function tipoConexion(){
    $tipoConexion = TC_TIPO_CONEXION::all();

    return TipoConexionApi::collection($tipoConexion);
  }

}
