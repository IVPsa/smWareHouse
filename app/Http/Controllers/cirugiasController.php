<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// modelos
use App\TC_TIPO_CONEXION;
use App\TI_TIPO_IMPLANTE;
use App\CLC_COLOR_CODING;
use App\PRO_PRODUCTOS;
use App\CIR_CIRUGIA;
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

    public function registarImplementos(){

    }

}
