@extends('layouts.app')
@section('content')
@include('layouts.messages')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<h3 class="text-center">Listado de cirugias</h3>

<div class="form-group row">

  <label  for="first_name" class="col-3 col-form-label text-right" >Buscar:</label>
  <div class="col-8">
    <input type="text" class="form-control" id="nompreProducto" name="nompreProducto"  >
  </div>
  <div class="col-1">
    <button class="btn btn-lg  btn-success"> <i class="fa fa-search"></i></button>
  </div>
</div>

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

                <td width="15px" >

                    <button class="btn btn-lg btn-info" data-toggle="tooltip"  data-placement="top" title="Ver articulos usados" >
                      <i class="fa fa-clipboard" ></i>
                     </button>

                </td>

              </tr>
          @endforeach


      </table>
    </div>
  {{ $listadoDeCirugias->links() }}
  </div>
</div>

@endsection
