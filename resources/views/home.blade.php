@extends('layouts.app')

@section('content')

                <!-- <div class="card-header">Dashboard</div> -->

              <div class="card-body">


                <h3 class="text-center">Bienvenido {{ Auth::user()->name }} a SM Ware House</h3>
                <br>

                <center>


                    <a href="{{route('catalogo')}}"><button type="button" class="btn btn-info"><i class="fa fa-clipboard" style="font-size:150px; width:202px;"></i> <br> CATALOGO</button></a>
                    <a href="{{route('indexBodega')}}"><button type="button" class="btn btn-warning"> <i class="fa fa-archive" style="font-size:150px; width:202px;"></i> <br> BODEGA</button></a>
                    <a href="{{route('Cirugias')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> CIRUGIAS</button></a>
                      <!-- <a href="{{route('pruebaLector')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> PRUEBA LECTOR</button></a> -->

                </center>
                <h4 class="text-center">CONTEO DE IMPLANTES POR RADIO Y LONGITUD</h4>
                <div class="table-responsive">

                  <table class="table table-bordered" align="center"  id="table">
                  <tr>
                    <td width="150">LONGITUD/RADIO</td>
                    <td class="bg-green">2.9</td>
                    <td class="bg-green">3.3</td>
                    <td class="bg-green">4.1</td>
                    <td class="bg-green">4.8</td>
                  </tr>
                  <tr>
                    <td class="bg-blue">8</td>
                    <td>
                    {{
                      $conteoGeneral = DB::table('ART_ARTICULOS')
                      ->where('ART_ARTICULOS.ART_PROD_COD',$implantesDe8x29)->sum('ART_ARTICULOS.ART_CANT')
                    }}
                    </td>
                    <td>
                    {{
                      $conteoGeneral = DB::table('ART_ARTICULOS')
                      ->where('ART_ARTICULOS.ART_PROD_COD',$implantesDe8x33)->sum('ART_ARTICULOS.ART_CANT')
                    }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',12)->orwhere('ART_ARTICULOS.ART_PROD_COD',3)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',5)->orwhere('ART_ARTICULOS.ART_PROD_COD',17)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-blue">10</td>
                    <td>
                    {{
                      $conteoGeneral = DB::table('ART_ARTICULOS')
                      ->where('ART_ARTICULOS.ART_PROD_COD',8)->sum('ART_ARTICULOS.ART_CANT')
                    }}
                    </td>
                    <td>
                    {{
                      $conteoGeneral = DB::table('ART_ARTICULOS')
                      ->where('ART_ARTICULOS.ART_PROD_COD',10)->orWhere('ART_ARTICULOS.ART_PROD_COD', 2)->sum('ART_ARTICULOS.ART_CANT')
                    }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',13)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',6)->orWhere('ART_ARTICULOS.ART_PROD_COD', 16)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>

                  </tr>
                  <tr>
                    <td class="bg-blue">12</td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',12)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',1)->orWhere('ART_ARTICULOS.ART_PROD_COD',11)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                    <td>
                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',4)->orWhere('ART_ARTICULOS.ART_PROD_COD',7)->orWhere('ART_ARTICULOS.ART_PROD_COD',14)->sum('ART_ARTICULOS.ART_CANT')
                      }}
                    </td>
                    <td>

                      {{
                        $conteoGeneral = DB::table('ART_ARTICULOS')
                        ->where('ART_ARTICULOS.ART_PROD_COD',15)->orWhere('ART_ARTICULOS.ART_PROD_COD', '2')->sum('ART_ARTICULOS.ART_CANT')
                      }}

                    </td>
                  </tr>
                  <tr>
                    <td class="bg-blue">14</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>
                </table>
                </div>
              </div>



@endsection
