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
      $implantesDe8x29Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x33Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'implante Bone Level guiado')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe8x41Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x48Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x29Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x33Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x41Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x48Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select(
      'PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe12x29Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x33Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x41Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x48Guiado=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante Guiado')
      ->sum('ART_ARTICULOS.ART_CANT');

      //no guiados
      $implantesDe8x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe8x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select(
      'PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');


      $implantesDe12x29=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x33=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x41=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x48=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION','<>', 'Implante Guiado')
      ->where('PROD_DESCRIPCION','<>', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      // SLA
      //sla 8
      $implantesDe8x29SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x33SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x41SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe8x48SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '8mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      //sla 10
      $implantesDe10x29SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x33SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x41SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe10x48SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '10mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      //sla 12
      $implantesDe12x29SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '2.9mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x33SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '3.3mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x41SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.1mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
      ->sum('ART_ARTICULOS.ART_CANT');

      $implantesDe12x48SLA=DB::table('ART_ARTICULOS')
      ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
      ->select('PRO_PRODUCTOS.PROD_COD')
      ->where('PROD_DIAMETRO', '4.8mm')
      ->where('PROD_LONGITUD', '12mm')
      ->where('PROD_DESCRIPCION', 'Implante SLA active')
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
          'implantesDe12x48',
          'implantesDe8x29Guiado',
          'implantesDe8x33Guiado',
          'implantesDe8x41Guiado',
          'implantesDe8x48Guiado',
          'implantesDe10x29Guiado',
          'implantesDe10x33Guiado',
          'implantesDe10x41Guiado',
          'implantesDe10x48Guiado',
          'implantesDe12x29Guiado',
          'implantesDe12x33Guiado',
          'implantesDe12x41Guiado',
          'implantesDe12x48Guiado',
          'implantesDe8x29SLA',
          'implantesDe8x33SLA',
          'implantesDe8x41SLA',
          'implantesDe8x48SLA',
          'implantesDe10x29SLA',
          'implantesDe10x33SLA',
          'implantesDe10x41SLA',
          'implantesDe10x48SLA',
          'implantesDe12x29SLA',
          'implantesDe12x33SLA',
          'implantesDe12x41SLA',
          'implantesDe12x48SLA'    ));
    }
}
