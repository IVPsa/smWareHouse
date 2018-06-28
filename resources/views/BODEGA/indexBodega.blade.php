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
        <div class="col-md-4   col-xs-12" align="center">
          <a href="{{route('ingresoDeArticulos')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:145px; width:202px;">playlist_add</i>
              <br />
              Ingreso De Articulos
            </button>
          </a>
        </div>

        <div class="col-md-4 col-xs-12" align="center">
          <a href="{{route('ListadoDeArticulos')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="fa fa-list-ul" style="font-size:150px; width:202px;"></i>
              <br />
              Inventario de Articulos
            </button>
          </a>
        </div>

        <div class="col-md-4 col-xs-12" align="center">
          <a href="{{route('ImplementosUtilizados')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:150px; width:202px;">folder_open</i>
              <br />
              Implementos Usados
            </button>
            </a>
        </div>



      </div>

    </div>
  </div>

  <br />
  <br />

<h2 class="text-center">
  <!-- <i class="fa fa-warning" style="font-size:48px;color:red"></i> -->
    <b>CONTEO GENERAL DE STOCK</b>
  <!-- <i class="fa fa-warning" style="font-size:48px;color:red"></i> -->
</h2>

<div class="row">
  @foreach($productos as $productos)
    <div class="col-md-4 col-xs-12">
      <div class="card">
        <div class="card-header bg-{{ $productos->CLC_COLOR}} text-white">
          <b>{{ $productos->PROD_NOMBRE }}</b>
          <br />
          LONGITUD: {{ $productos->PROD_LONGITUD }}
          <br />
          DIAMETRO: {{ $productos->PROD_DIAMETRO }}∅
        </div>
        <div class="card-body">
            <b>CANTIDAD:</b>
            <h5>{{
              $conteoGeneral = DB::table('ART_ARTICULOS')
              ->where('ART_ARTICULOS.ART_PROD_COD', $productos->PROD_COD)->sum('ART_ARTICULOS.ART_CANT')
            }}@if ($conteoGeneral <=5)
            <i class="fa fa-warning" style="font-size:24px;color:red" data-toggle="tooltip" data-placement="top" title="STOCK CRITICO"></i>
            @else
            @endif</h5>

            <br >

            <b>TIPO:</b>
            <h5> {{ $productos->TI_CLASE}}</h5>
            <br>

            <b>NUMERO DE ARTICULO:</b>
            <h5> {{ $productos->PROD_N_ARTICULO }}</h5>
            <br>

            <b>TIPO DE CONEXION:</b>
            <h5> {{ $productos->TC_DES}}</h5>
            <center>
              <a href="{{route('agregarExistenciasPorCodigoDeProducto',  $productos->PROD_COD )}}" >
                 <button class="btn btn-lg btn-success"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Agregar Existencias">
                   <i class="material-icons" >library_add</i>
                 </button>
              </a>

              <a href="{{route('fichaDeProducto', $productos->PROD_COD)}}">
                 <button class="btn btn-lg btn-info"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha De Producto">
                   <i class="fa fa-clipboard" ></i>
                  </button>
               </a>
            </center>
        </div>
      </div>
    </div>
  @endforeach
</div>

<!-- <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
    <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>LONGITUD</th>
          <th>DIAMETRO</th>
          <th>N ART.</th>
          <th>TIPO CONEXION</th>
          <th>TIPO DE IMPLANTE</th>
          <th>COLOR</th>
          <th>CANT</th>
          <th width="100px" colspan="2" >ACCION</th>

        </tr>
    </thead>



      <tr>
        <td>{{ $productos->PROD_COD }}</td>
        <td>{{ $productos->PROD_NOMBRE }}</td>

        <td>{{ $productos->PROD_LONGITUD }}</td>
        <td>{{ $productos->PROD_DIAMETRO }}∅</td>
        <td>{{ $productos->PROD_N_ARTICULO }}</td>
        <td> {{ $productos->TC_DES}}</td>
        <td> {{ $productos->TI_CLASE}}</td>
        <td> {{ $productos->CLC_COLOR}}</td>

        <td>

          {{
            $conteoGeneral = DB::table('ART_ARTICULOS')
            ->where('ART_ARTICULOS.ART_PROD_COD', $productos->PROD_COD)->sum('ART_ARTICULOS.ART_CANT')
          }}
        </td>


        <td width="15px" >
           <a href="{{route('agregarExistenciasPorCodigoDeProducto',  $productos->PROD_COD )}}" >
              <button class="btn btn-lg btn-success"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Agregar Existencias">
                <i class="material-icons" >library_add</i>
              </button>
           </a>
        </td>
        <td width="15px" >
          <a href="{{route('fichaDeProducto', $productos->PROD_COD)}}">
            <button class="btn btn-lg btn-info"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha De Producto">
              <i class="fa fa-clipboard" ></i>
             </button>
          </a>
        </td>




</table> -->



@endsection
