@extends('layouts.app')
@section('content')
@include('layouts.messages')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h3 class="text-center ">Implementos Usados Para la cirugia</h3>

<div class="container">
  <div class="form-group row">
    <label for="last_name" class=" col-3 col-form-label text-right">NOMBRE DEL PACIENTE:</label>
    <div class="col-9">
      <input type="text"   maxlength="16" class="form-control" id="nombrePaciente" name="nombrePaciente"  value="{{$fichaCirugia->CIR_NOMBRE_PACIENTE}}" readonly>
    </div>

  </div>


  <div class="form-group row">
  <label  for="first_name" class="col-3 col-form-label text-right">RUT DEL PACIENTE:</label>
  <div class="col-9 " >
    <input type="text" class="form-control" id="rut" name="rut" value="{{$fichaCirugia->CIR_RUT_PACIENTE}}"  readonly>
  </div>
  </div>

  <div class="form-group row">
  <label  for="first_name" class="col-3 col-form-label text-right">FECHA DE LA CIRUGIA:</label>
  <div class="col-9 " >
    <input type="date" class="form-control" id="fecha" name="fecha" value="{{$fichaCirugia->CIR_FECHA}}"  readonly>
  </div>
  </div>
</div>



@if ($comprobacionDeEstado== "REALIZADA")
@else

<form action="{{route('registrarImplementosAusar' ,$fichaCirugia->CIR_COD)}}" method="post"   class="form-group row">


      <div class="container"  >
        @csrf
        <div class="form-group row">
            <label for="last_name" class=" col-12 col-form-label ">DIENTE:</label>
            <div class="col-12">
              <select class="form-control" name="piezaDental">

                @foreach ( $piezasDentales as $piezasDentales)
                  <option value="{{$piezasDentales->PD_COD}}"> {{$piezasDentales->PD_SECTOR}} - {{$piezasDentales->PD_N_DIENTE}} - {{$piezasDentales->PD_NOMBRE}} </option>
                @endforeach

              </select>
            </div>
            <!-- <div class="col-6">
            <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
          </div> -->
        </div>

        <div class="form-group row">
          <label for="last_name" class=" col-12 col-form-label ">IMPLANTE A USAR EN EL DIENTE:</label>
          <div class="col-12">
            <select class="form-control" name="implante">
              @if ($articulos == "[]")
                <option>No hay stock</option>
              @else
                @foreach ( $articulos as $articulos)
                  <option value="{{$articulos->ART_COD}}">
                    {{$articulos->PROD_NOMBRE}} -
                    {{$articulos->PROD_DIAMETRO}}∅ -
                    {{$articulos->PROD_LONGITUD}} L -
                    {{$articulos->TC_DES}} -

                    {{$articulos->CLC_COLOR}}
                  </option>

                @endforeach
              @endif
            </select>
          </div>

        </div>

        @endif

        <div class="form-group row">
          @if ($articulos == "[]")
            <div class=" col-12">
              <h4 class="text-center">Debe ingresar implantes a bodega para poder continuar</h4>
            </div>
            @else
              @if ($comprobacionDeEstado== "REALIZADA")

                <div class="col-md-12 col-xs-12">
                  <div class="table-responsive" >
                    <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
                        <thead class="thead-dark">
                            <tr>
                              <th>DIENTE</th>
                              <th>NOMBRE</th>
                              <th>LONGITUD</th>
                              <th>DIAMETRO</th>
                              <th>TIPO CONEXION.</th>
                              <th>TIPO IMPLANTE.</th>
                              <th>COLOR CODING.</th>
                              <th colspan="2">ACCION</th>




                            </tr>
                        </thead>
                        @foreach ($listaImplementos as $listaImplementos)
                            <tr>

                              <td> {{$listaImplementos->PD_N_DIENTE}} {{$listaImplementos->PD_NOMBRE}}</td>
                              <td>{{$listaImplementos->PROD_NOMBRE}}</td>
                              <td>{{$listaImplementos->PROD_LONGITUD}}</td>
                              <td>{{$listaImplementos->PROD_DIAMETRO}}</td>
                              <td>{{$listaImplementos->TC_DES}}</td>
                              <td>{{$listaImplementos->TI_CLASE}}</td>
                              <td>{{$listaImplementos->CLC_COLOR}}</td>
                              <td width="15px" >
                                <a href="{{route('fichaDeProducto', $listaImplementos->PROD_COD)}}">
                                  <button class="btn btn-lg btn-info"  style="width:50px; height:50px;" data-toggle="tooltip" data-Placement="top" title="Ver Ficha De Producto" >
                                    <i class="fa fa-clipboard" ></i>
                                  </button>
                                </a>
                              </td>

                              <td width="15px" >
                                <a href="{{route('fichaDeArticulo', $listaImplementos->ART_COD)}}">
                                  <button class="btn btn-lg btn-warning"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha De Articulo">
                                    <i class="material-icons">content_copy</i>
                                   </button>
                                </a>
                              </td>

                            </tr>
                        @endforeach



                    </table>
                  </div>

                </div>


              @else
              <div class="offset-5 col-7">
                  <button type="submit" class="btn btn-success btn-lg">INGRESAR</button>
              </div>
              @endif
            @endif

        </div>

      </div>
</form>
    @if ($comprobacionDeEstado== "REALIZADA")
    @else
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="table-responsive" >
            <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
                <thead class="thead-dark">
                    <tr>
                      <th>DIENTE</th>
                      <th>NOMBRE</th>
                      <th>LONGITUD</th>
                      <th>DIAMETRO</th>
                      <th>TIPO CONEXION.</th>
                      <th>TIPO IMPLANTE.</th>
                      <th>COLOR CODING.</th>

                      <th>ACCION</th>


                    </tr>
                </thead>
                @foreach ($listaImplementos as $listaImplementos)
                    <tr>

                      <td> {{$listaImplementos->PD_N_DIENTE}} {{$listaImplementos->PD_NOMBRE}}</td>
                      <td>{{$listaImplementos->PROD_NOMBRE}}</td>
                      <td>{{$listaImplementos->PROD_LONGITUD}}</td>
                      <td>{{$listaImplementos->PROD_DIAMETRO}}</td>
                      <td>{{$listaImplementos->TC_DES}}</td>
                      <td>{{$listaImplementos->TI_CLASE}}</td>
                      <td>{{$listaImplementos->CLC_COLOR}}</td>

                      <td>
                          <a href="{{route('quitarImplemento' , $listaImplementos->ART_COD)}}">
                            <button type="button"  class="btn btn-lg btn-danger"  data-toggle="tooltip" data-Placement="top"  title=" Eliminar implante" ><i class="fa fa-remove"></i></button>
                          </a>



                      </td>
                    </tr>
                @endforeach



            </table>
          </div>

        </div>
      </div>
    @endif

@endsection
