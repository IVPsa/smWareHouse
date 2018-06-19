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
      return response()->json (422);

    }

      $Revisarlote=ART_ARTICULOS::where('ART_UDI',$udi01)->value('ART_LOTE');
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

        $udi01=$request->input('ART_UDI');
        //Conseguir este dato por alguna otra forma
        $codReferencia=PRO_PRODUCTOS::where('PROD_UDI_01',$udi01)->value('PROD_COD');

          $ingresarArticulo= ART_ARTICULOS::create([
            'ART_UDI'=>$request->input('ART_UDI'),
            'ART_PROD_COD'=>$codReferencia,
            'ART_FECHA_EXP'=>$request->input('ART_FECHA_EXP'),
            'ART_LOTE'=>$request->input('ART_FECHA_EXP'),
            'ART_CANT'=>$request->input('ART_CANT'),
            'updated_at'=> Carbon::now(),
            'created_at'=> Carbon::now()
          ]);

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
}
