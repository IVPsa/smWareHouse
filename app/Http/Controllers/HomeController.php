<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\ART_ARTICULOS;
use App\User;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $implantesDe8x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')->where('PROD_LONGITUD', '8mm')->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '8mm')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe8x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '8mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '8mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '10mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')

      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '10mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')

      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '10mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select(
      'PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '10mm')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe12x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')

      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '12mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '12mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '12mm')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '12mm')
      ->sum('ART_ARTICULOS.ART_CANT');

        return view('home',compact(
          'implantesDe8x29',
          'implantesDe8x33',
          'implantesDe8x41',
          'implantesDe8x48',
          'implantesDe10x29',
          'implantesDe10x33',
          'implantesDe10x41',
          'implantesDe10x48',
          'implantesDe12x29',
          'implantesDe12x33',
          'implantesDe12x41',
          'implantesDe12x48'));
    }
}
