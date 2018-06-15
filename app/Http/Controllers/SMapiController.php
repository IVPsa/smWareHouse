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
    // return ArticulosApi::collection($Articulo);
  }

  public function AgregarArticulo(Request $request){

    $Articulo=ART_ARTICULOS::create($request->all());

    return $Articulo;

  }

  public function ActualizarExistencias($id, Request $request){
     $CANTIDAD=$request->input('ART_CANT');

     $Articulo= ART_ARTICULOS::where('ART_COD',$id)->update([

       'ART_CANT'=>$CANTIDAD
     ]);


    return $Articulo;

  }

  //FIN API ART_ARTICULOS
}
