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


class SMapiController extends Controller
{

  //INICIO API ART_ARTICULOS
  public function ListadoDeArticulos(){

  $listadoDeArticulos = DB::table('ART_ARTICULOS')
    ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')

    ->select('PRO_PRODUCTOS.PROD_UDI_01',
    'ART_ARTICULOS.ART_COD',
    'ART_ARTICULOS.ART_UDI',
    'ART_ARTICULOS.ART_LOTE',
    'ART_ARTICULOS.ART_FECHA_EXP',
    'ART_ARTICULOS.ART_CANT',
    'ART_ARTICULOS.ART_PROD_COD'
    )->paginate();

    return response()->json($listadoDeArticulos, 200);

  }

  //FIN API ART_ARTICULOS
}
