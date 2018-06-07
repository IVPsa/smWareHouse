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
        'CIR_DESCRIPCION'=>$request->input('descripcionCirugia'),
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
          ->Join('CLC_COLOR_CODING', 'CLC_COLOR_CODING.CLC_COD', '=', 'PRO_PRODUCTOS.PROD_CLC_COD')
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
          )->where('ART_ARTICULOS.ART_CANT', '>', 0)->get();



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




        return view('CIRUGIAS.RegistroDeImplementos',compact('piezasDentales','articulos', 'fichaCirugia', 'listaImplementos'));

    }

      public function registrarImplementosAusar(Request $request, $id){

          $fechaCirugia=DB::table('CIR_CIRUGIA')->select('CIR_FECHA')->where('CIR_COD',$id)->value('CIR_FECHA');

        $idArt=$request->input('implante');
        $registarImplementoUsado= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create([
          'IUC_ART_COD'=>$idArt,
          'IUC_CIR_COD'=>$id,
          'IUC_PD_COD'=>$request->input('piezaDental'),
          'IUC_FECHA_DE_USO'=> $fechaCirugia,
          'updated_at'=> Carbon::now(),
          'created_at'=> Carbon::now()
        ]);



          $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_COD', $idArt)->value('ART_CANT');

          if ($valorActual==0){
            return redirect()->route('showRegistarImplementos',$id)->with('error', "implemento sin stock.");
          }


          $valorFinal=$valorActual-1;


          $actualizarRegistroEnBodega=ART_ARTICULOS::where('ART_COD',$idArt)->update([

            'ART_CANT'=>$valorFinal
          ]);
          //nota falta aun modificar esta funcion para que se reste una existencia del implante seleccionado


          if (!$registarImplementoUsado ) {
            return redirect()->route('showRegistarImplementos',$id)->with('error', "Hubo un problema al registar el implemento.");
          }

            return redirect()->route('showRegistarImplementos',$id)->with('success', "Se ha registrado el implemento correctamente.");


      }

      public function quitarImplemento( Request $request, $id ){

        // $idArt= CIR_CIRUGIA::where('CIR_COD',$id)->value('CIR_ART_COD');

        $valorActual=DB::table('ART_ARTICULOS')->select('ART_CANT')->where('ART_COD', $id)->value('ART_CANT');

        $valorFinal=$valorActual+1;

        $actualizarRegistroEnBodega=ART_ARTICULOS::where('ART_COD',$id)->update([

          'ART_CANT'=>$valorFinal
        ]);

        $quitarImplemento= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::where('IUC_ART_COD',$id)->delete();

        $listaImplementosId=DB::table('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS')
        ->select('UIC_COD')
        ->where('IUC_ART_COD',$id)
        ->value('UIC_COD');

        if($listaImplementosId==null){
            return redirect()->route('listaDeCirugias')->with('success', "Se elimino correctamente.");
        }
        else{
          if (!$quitarImplemento) {
            return redirect()->route('listaDeCirugias')->with('error', "No se Pudo Eliminar.");
          }
          return redirect()->route('showRegistarImplementos',$listaImplementosId)->with('success', "Se ha eliminado correctamente.");
          // return redirect()->route('listaDeCirugias')->with('success', "Se ha eliminado correctamente.");
        }

      }

      public function eliminarCirugia($id ){


        $eliminarCirugia= IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::where('IUC_ART_COD',$id)->delete();



        if (!$eliminarCirugia) {
          return redirect()->route('listaDeCirugias')->with('error', "No se Pudo Eliminar.");
        }

          return redirect()->route('listaDeCirugias')->with('success', "Se ha eliminado correctamente.");

      }

      public function BuscadorDeCirugias(Request $request){

        $datoBuscar=$request->input('datoAbuscar');

        $listadoDeCirugias=DB::table('CIR_CIRUGIA')
                ->where( 'CIR_NOMBRE_PACIENTE','like', '%'. $datoBuscar .'%' )
                ->paginate();
        return view('CIRUGIAS.listaCirugias',compact('listadoDeCirugias'));
      }

}
