<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// modelos
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\CIR_CIRUGIA;
use App\PD_PIEZAS_DENTALES;
use App\ART_ARTICULOS;
use App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS;
use App\User;

use App\Http\Controllers\Controller;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class cirugiasController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function listaDeCirugias()
    {
      $listadoDeCirugias=DB::table('CIR_CIRUGIA')->paginate();

      return view('CIRUGIAS.listaCirugias',compact('listadoDeCirugias'));

    }

    public function fichaCirugia($id){

      $fichaCirugia = CIR_CIRUGIA::find($id);

      return view('CIRUGIAS.fichaCirugia', compact('fichaCirugia'));


    }

    public function  registrarCirugia(Request $request){


      $registarCirugia= CIR_CIRUGIA::create([
        'CIR_NOMBRE_PACIENTE'=>$request->input('nombrePaciente'),
        'CIR_RUT_PACIENTE'=>$request->input('rut'),
        'CIR_FECHA'=>$request->input('fecha'),
        'updated_at'=> Carbon::now(),
        'created_at'=> Carbon::now()
      ]);

      if (!$registarCirugia) {
        return redirect()->route('Cirugias')->with('error', "Hubo un problema al registar la cirugia.");
      }

        return redirect()->route('Cirugias')->with('success', "Se ha registrado la cirugia exitosamente.");


    }


    public function  actualizarCirugia( Request $request, $id){

      $actualizarCirugia = CIR_CIRUGIA::where('CIR_COD',$id)->update([
        'CIR_NOMBRE_PACIENTE'=>$request->input('nombrePaciente'),
        'CIR_RUT_PACIENTE'=>$request->input('rut'),
        'CIR_FECHA'=>$request->input('fecha')
      ]);

      if (!$actualizarCirugia) {
        return redirect()->route('Cirugias')->with('error', "Hubo un problema al registar la cirugia.");
      }

        return redirect()->route('Cirugias')->with('success', "Se ha registrado la cirugia exitosamente.");

    }

    public function showRegistarImplementos($id){

        $fichaCirugia = CIR_CIRUGIA::find($id);
        $piezasDentales= PD_PIEZAS_DENTALES::all();
        // $articulos= ART_ARTICULOS::all();


          $articulos = DB::table('ART_ARTICULOS')
          ->Join('PRO_PRODUCTOS', 'PRO_PRODUCTOS.PROD_COD', '=', 'ART_ARTICULOS.ART_PROD_COD')
          ->Join('TC_TIPO_CONEXION', 'TC_TIPO_CONEXION.TC_COD', '=', 'PRO_PRODUCTOS.PROD_TC_COD')
          ->Join('TI_TIPO_IMPLANTE', 'TI_TIPO_IMPLANTE.TI_COD', '=', 'PRO_PRODUCTOS.PROD_TI_COD')
          ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COLOR', '=', 'CLC_COLOR_CODING.CLC_COLOR')
          ->select('PRO_PRODUCTOS.PROD_UDI_01',

          'PRO_PRODUCTOS.PROD_NOMBRE',
          'PRO_PRODUCTOS.PROD_N_ARTICULO',
          'PRO_PRODUCTOS.PROD_DIAMETRO',
          'PRO_PRODUCTOS.PROD_LONGITUD',
          'ART_ARTICULOS.ART_COD',
          'ART_ARTICULOS.ART_UDI',
          'ART_ARTICULOS.ART_LOTE',
          'ART_ARTICULOS.ART_FECHA_EXP',
          'ART_ARTICULOS.ART_CANT',
          'ART_ARTICULOS.ART_PROD_COD',
          'TC_TIPO_CONEXION.TC_DES',
          'TI_TIPO_IMPLANTE.TI_DES',
          'CLC_COLOR_CODING.CLC_COLOR'
          )->get();

          // $listaImplementos = IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::WHERE($id);  


        // $datosDelImplante = DB::table('ART_ARTICULOS')
        // ->Join('PRO_PRODUCTOS', 'PROD_PRODUCTOS.PROD_COD', '=', 'PROD_PRODUCTOS.PROD_COD')
        //
        // ->select(
        //
        // 'ART_ARTICULOS.ART_COD',
        // 'ART_ARTICULOS.ART_UDI',
        // 'ART_ARTICULOS.ART_FECHA_EXP',
        // 'ART_ARTICULOS.ART_LOTE',
        // 'PROD_PRODUCTOS.PROD_NOMBRE',
        // 'PROD_PRODUCTOS.PROD_DIAMETRO',
        // 'PROD_PRODUCTOS.PROD_LONGITUD',
        // 'PROD_PRODUCTOS.PROD_DESCRIPCION'
        // )->where('ART_ARTICULOS.ART_COD', 4);
        // dd($datosDelImplante);

        // $encargadoDelReporte = DB::table('REP_REPORTE')
        // ->Join('users', 'users.id', '=', 'users.id')
        //
        // ->select('users.USER_NOMBRE','REP_REPORTE.REP_COD','REP_REPORTE.REP_USER_ID')
        // ->where('REP_COD',$id )
        // ->value('USER_NOMBRE');

        return view('CIRUGIAS.registroDeImplementos',compact('piezasDentales','articulos', 'fichaCirugia', 'listaImplementos'));

    }

      public function registarrImplementosAusar(Request $request, $id){

        $registarImplementoUsado= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create([
          'IUC_ART_COD'=>$request->input('implante'),
          'IUC_CIR_COD'=>$request->input('$id'),
          'UIC_PD_COD'=>$request->input('piezaDental'),
          'updated_at'=> Carbon::now(),
          'created_at'=> Carbon::now()
        ]);
        //nota falta aun modificar esta funcion para que se reste una existencia del implante seleccionado

        if (!$registarImplementoUsado) {
          return redirect()->route('Cirugias')->with('error', "Hubo un problema al registar la cirugia.");
        }

          return redirect()->route('Cirugias')->with('success', "Se ha registrado la cirugia exitosamente.");


      }

}
