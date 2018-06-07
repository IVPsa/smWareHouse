@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h3 class="text-center display-3">CATALOGO</h3>

<div class="row">
  <div class="col-md-12">
    <div class="row">

      <div class="col-md-6 col-sm-12" align="center">
           <a href="{{route('listaProductos')}}">
             <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
               <i class="fa fa-list-alt" style="font-size:150px; width:202px;"></i>
               <br />
               Lista De Productos
             </button>
          </a>
      </div>

      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('nuevoProducto')}}">
          <button type="button" class="btn btn-success btn-lg " style="width:240px; height:200px;">
            <i class="fa fa-pencil-square-o" style="font-size:150px; width:202px;"></i>
            <br />
            Nuevo Producto
          </button>
        </a>
      </div>

    </div>
  </div>

</div>

@endsection
