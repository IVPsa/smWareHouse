@extends('layouts.app')
@section('content')
@include('layouts.messages')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h3 class="text-center">Lista De articulos en bodega</h3>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>UDI COMPLETO</th>
                <th>UDI (01)</th>
                <th>LOTE</th>
                <th>FECHA EXP</th>
                <th>CANT</th>

                <th width="100px" colspan="2" >ACCION</th>
              </tr>
          </thead>
        @foreach($listadoDeArticulos as $lista)
          <tr>
            <td>{{ $lista->ART_COD }}</td>
            <td>{{ $lista->ART_UDI }}</td>
            <td>{{ $lista->PROD_UDI_01 }}</td>
            <td>{{ $lista->ART_LOTE }}</td>
            <td>{{ $lista->ART_FECHA_EXP }}</td>
            <td>{{ $lista->ART_CANT }}</td>


            <td width="15px" >
               <a href="{{route('showActualizarExistencias',$lista->ART_COD)}}" >
                  <button class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Agregar Existencias">
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
  {{ $listadoDeArticulos->links() }}
  </div>
</div>

@endsection
