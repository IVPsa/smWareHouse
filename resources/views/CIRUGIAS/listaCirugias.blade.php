@extends('layouts.app')
@section('content')
@include('layouts.messages')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<h3 class="text-center display-3">Listado De Cirugias</h3>

<form class="" action="{{route('buscador')}}" method="get">

  <div class="form-group row">

      <label  for="first_name" class="col-3 col-form-label text-right" >Buscar Por Nombre:</label>
      <div class="col-8">
        <input type="text" class="form-control"  name="datoAbuscar"  >
      </div>
      <div class="col-1">
        <button type="submit" class="btn btn-lg  btn-success"> <i class="fa fa-search"></i></button>
      </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>NOMBRE DEL PACIENTE</th>
                <th>RUT</th>
                <th width="200px" >FECHA DE LA CIRUGIA</th>

                <th width="100px" colspan="2" >ACCION</th>
              </tr>
          </thead>
        @foreach($listadoDeCirugias as $lista)
              <tr>
                <td>{{ $lista->CIR_COD }}</td>
                <td>{{ $lista->CIR_NOMBRE_PACIENTE }}</td>
                <td>{{ $lista->CIR_RUT_PACIENTE }}</td>
                <td>{{ $lista->CIR_FECHA }}</td>

                <td width="15px" >

                      <a href="{{route('fichaCirugia', $lista->CIR_COD)}}">
                        <button class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Ver ficha de la cirugia" >
                           <i class="fa fa-play"></i>
                        </button>
                      </a>

                </td>

                <!-- <td width="15px">
                  <a href="{{route('eliminarCirugia' , $lista->CIR_COD)}}"><button type="button"  class="btn btn-lg btn-danger"  data-toggle="tooltip" data-Placement="top"  title=" Eliminar cirugia" id="Eliminar"><i class="fa fa-remove"></i></button></a>
                </td> -->

                <td width="15px" >
                  <a href="{{route('showRegistarImplementos',$lista->CIR_COD)}}">
                    <button class="btn btn-lg btn-info" data-toggle="tooltip"  data-placement="top" title="Ver articulos usados" >
                      <i class="material-icons">content_paste</i>
                     </button>
                  </a>
                </td>


              </tr>
          @endforeach


      </table>
    </div>
  {{ $listadoDeCirugias->links() }}
  </div>
</div>

@endsection
