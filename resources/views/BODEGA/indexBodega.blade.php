@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h3 class="text-center">BODEGA</h3>



<div class="row">
  <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 col-xs-12" align="center">
          <a href="{{route('ingresoDeArticulos')}}"><button type="button" class="btn btn-success btn-lg"> Ingreso De Articulos</button></a>
        </div>

        <div class="col-md-6 col-xs-12" align="center">
          <a href="{{route('ListadoDeArticulos')}}"><button type="button" class="btn btn-success btn-lg">Inventario de Articulos</button></a>
        </div>

        <!-- <div class="col-md-4 col-xs-12" align="center">
          <button type="button" class="btn btn-success btn-lg"> Registro De Mermas</button>
        </div> -->

      </div>

    </div>
  </div>

</div>
@endsection
