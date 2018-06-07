@extends('layouts.app')
@section('content')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h3 class="text-center display-3">Lista De Implantes Usados</h3>


<form  action="{{route('buscarImplementos')}}" method="get">

  <div class="form-group row">

      <label  for="first_name" class="col-3 col-form-label text-right" >Buscar Desde:</label>
      <div class="col-8">
        <input type="date" class="form-control"  name="fechaDesde"    required>

      </div>
      <label  for="first_name" class="col-3 col-form-label text-right" >Buscar Hasta:</label>
      <div class="col-8">
        <input type="date" class="form-control"  name="fechaHasta"  required>
      </div>

      <div class=" offset-6 col-6">
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
                <th>FECHA DE USO</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>LOTE</th>
                <th>FECHA EXP</th>



                <th width="100px" colspan="2" >ACCION</th>

              </tr>
          </thead>
          @foreach($listaDeUsados as $lista)
          <tr>
              <td>{{$lista-> IUC_FECHA_DE_USO  }}</td>
              <td>{{$lista-> PROD_NOMBRE}}</td>
              <td>{{$lista-> PROD_DESCRIPCION}}</td>
              <td>{{$lista-> ART_LOTE}}</td>
              <td>{{$lista-> ART_FECHA_EXP}}</td>
              <td>
                <a href="{{route('fichaCirugia', $lista->IUC_CIR_COD)}}">
                  <button class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Ver ficha de la cirugia" >
                     <i class="fa fa-play"></i>
                  </button>
                </a>
              </td>
              <td width="15px" >
                <a href="{{route('fichaDeProducto', $lista->ART_PROD_COD)}}">
                  <button class="btn btn-lg btn-info" data-toggle="tooltip" data-placement="top" title="Ver Ficha De Producto">
                    <i class="fa fa-clipboard" ></i>
                   </button>
                </a>
              </td>

          </tr>
          @endforeach


      </table>
    </div>
    {{ $listaDeUsados->links() }}

  </div>
</div>

@endsection
