@extends('layouts.app')
@section('content')
@include('layouts.messages')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h1 class="display-3 text-center">BODEGA</h1>

<div class="row">
  <div class="col-md-12">
      <div class="row">
        <div class="col-md-3 col-xs-12" align="center">
          <a href="{{route('ingresoDeArticulos')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:145px; width:202px;">playlist_add</i>
              <br />
              Ingreso De Articulos
            </button>
          </a>
        </div>

        <div class="col-md-3 col-xs-12" align="center">
          <a href="{{route('ListadoDeArticulos')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="fa fa-list-ul" style="font-size:150px; width:202px;"></i>
              <br />
              Inventario de Articulos
            </button>
          </a>
        </div>

        <div class="col-md-3 col-xs-12" align="center">
          <a href="{{route('ImplementosUtilizados')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:150px; width:202px;">folder_open</i>
              <br />
              Implementos Usados
            </button>
            </a>
        </div>

        <div class="col-md-3 col-xs-12" align="center">
          <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
            <i class="material-icons" style="font-size:150px; width:202px;">shopping_cart</i>
            <br />
            Ordenes De Compra
          </button>
        </div>

      </div>

    </div>
  </div>

  <br />
  <br />

  @if ($condicional == 0)

  @else
   <div class="row">
    <div class="col-md-12">

      <h3 class="text-center">
        <i class="fa fa-warning" style="font-size:48px;color:red"></i>
          <b>ARICULOS BAJOS DE STOCK</b>
        <i class="fa fa-warning" style="font-size:48px;color:red"></i>
      </h3>
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
              @foreach($stockCritico as $lista)
                <tr>
                  <td>{{ $lista->ART_COD }}</td>
                  <td>{{ $lista->ART_UDI }}</td>
                  <td>{{ $lista->PROD_UDI_01 }}</td>
                  <td>{{ $lista->ART_LOTE }}</td>
                  <td>{{ $lista->ART_FECHA_EXP }}</td>
                  <td>{{ $lista->ART_CANT }}</td>


                  <td width="15px" >
                     <a href="{{route('showActualizarExistencias',$lista->ART_COD)}}" >
                        <button class="btn btn-lg btn-success" style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Agregar Existencias">
                          <i class="material-icons">library_add</i>
                        </button>
                     </a>
                  </td>
                  <td width="15px" >
                    <a href="{{route('fichaDeProducto', $lista->ART_PROD_COD)}}">
                      <button class="btn btn-lg btn-info" style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha De Producto">
                        <i class="fa fa-clipboard" ></i>
                       </button>
                    </a>
                  </td>

                </tr>
                @endforeach


            </table>

    </div>
    {{ $stockCritico->links() }}

  </div>
  @endif

</div>
@endsection
