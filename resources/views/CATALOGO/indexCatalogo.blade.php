@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h3 class="text-center">CATALOGO</h3>

<div class="row">
  <div class="col-md-12">
    <div class="row">

      <div class="col-md-6 col-sm-12" align="center">
           <a href="{{route('listaProductos')}}">
             <button type="button" class="btn btn-success btn-lg">Lista De Productos</button>
          </a>
      </div>

      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('nuevoProducto')}}"><button type="button" class="btn btn-success btn-lg ">Nuevo Producto</button></a>
      </div>

    </div>
  </div>

</div>

@endsection
