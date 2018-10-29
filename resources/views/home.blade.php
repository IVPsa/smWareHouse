@extends('layouts.app')

@section('content')

                <!-- <div class="card-header">Dashboard</div> -->

              <div class="card-body">


                <h3 class="text-center">Bienvenido {{ Auth::user()->name }} a SM Ware House</h3>
                <br>

                <center>


                    <a href="{{route('catalogo')}}"><button type="button" class="btn btn-info"><i class="fa fa-clipboard" style="font-size:150px; width:202px;"></i> <br> CATALOGO</button></a>
                    <a href="{{route('IndexBodega')}}"><button type="button" class="btn btn-warning"> <i class="fa fa-archive" style="font-size:150px; width:202px;"></i> <br> BODEGA</button></a>
                    <a href="{{route('Cirugias')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> CIRUGIAS</button></a>
                      <!-- <a href="{{route('pruebaLector')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> PRUEBA LECTOR</button></a> -->

                </center>
                <h4 class="text-center">CONTEO DE IMPLANTES NO GUIADOS POR RADIO Y LONGITUD</h4>
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
                      {{$implantesDe8x29}}
                    </td>
                    <td>
                      {{$implantesDe8x33}}
                    </td>

                    <td>
                      {{$implantesDe8x41}}
                    </td>

                    <td>
                      {{$implantesDe8x48}}
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-blue">10</td>
                    <td>
                      {{$implantesDe10x29}}
                    </td>
                    <td>
                      {{$implantesDe10x33}}
                    </td>
                    <td>
                      {{$implantesDe10x41}}
                    </td>
                    <td>
                      {{$implantesDe10x48}}
                    </td>

                  </tr>
                  <tr>
                    <td class="bg-blue">12</td>
                    <td>
                      {{$implantesDe12x29}}
                    </td>
                    <td>
                      {{$implantesDe12x33}}
                    </td>
                    <td>
                      {{$implantesDe12x41}}
                    </td>
                    <td>
                      {{$implantesDe12x48}}
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

              <h4 class="text-center">CONTEO DE IMPLANTES SLA ACTIVE POR RADIO Y LONGITUD</h4>
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
                    {{$implantesDe8x29SLA}}
                  </td>
                  <td>
                    {{$implantesDe8x33SLA}}
                  </td>

                  <td>
                    {{$implantesDe8x41SLA}}
                  </td>

                  <td>
                    {{$implantesDe8x48SLA}}
                  </td>
                </tr>
                <tr>
                  <td class="bg-blue">10</td>
                  <td>
                    {{$implantesDe10x29SLA}}
                  </td>
                  <td>
                    {{$implantesDe10x33SLA}}
                  </td>
                  <td>
                    {{$implantesDe10x41SLA}}
                  </td>
                  <td>
                    {{$implantesDe10x48SLA}}
                  </td>

                </tr>
                <tr>
                  <td class="bg-blue">12</td>
                  <td>
                    {{$implantesDe12x29SLA}}
                  </td>
                  <td>
                    {{$implantesDe12x33SLA}}
                  </td>
                  <td>
                    {{$implantesDe12x41SLA}}
                  </td>
                  <td>
                    {{$implantesDe12x48SLA}}
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

              <h4 class="text-center">CONTEO DE GUIADOS POR RADIO Y LONGITUD</h4>
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
                      {{$implantesDe8x29Guiado}}
                    </td>
                    <td>
                      {{$implantesDe8x33Guiado}}
                    </td>

                    <td>
                      {{$implantesDe8x41Guiado}}
                    </td>

                    <td>
                      {{$implantesDe8x48Guiado}}
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-blue">10</td>
                    <td>
                      {{$implantesDe10x29Guiado}}
                    </td>
                    <td>
                      {{$implantesDe10x33Guiado}}
                    </td>
                    <td>
                      {{$implantesDe10x41Guiado}}
                    </td>
                    <td>
                      {{$implantesDe10x48Guiado}}
                    </td>

                  </tr>
                  <tr>
                    <td class="bg-blue">12</td>
                    <td>
                      {{$implantesDe12x29Guiado}}
                    </td>
                    <td>
                      {{$implantesDe12x33Guiado}}
                    </td>
                    <td>
                      {{$implantesDe12x41Guiado}}
                    </td>
                    <td>
                      {{$implantesDe12x48Guiado}}
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


@endsection
