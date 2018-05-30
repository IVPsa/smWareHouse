@extends('layouts.app')
@section('content')

<h3 class="text-center">PRODUCTO: {{$producto->PROD_NOMBRE}}   ID: {{$producto->PROD_COD}}</h3>
    <!-- <form action="{{route('nuevoProducto')}}" method="get"   class="form-group row"> -->

      <div class="container"  >
        @csrf

        <div class="form-group row">

          <label  for="first_name" class="  col-3 col-form-label text-right">NOMBRE:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nompreProducto" name="nompreProducto" value="{{$producto->PROD_NOMBRE}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">DESCRIPCION:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="descProducto" name="descProducto" value="{{$producto->PROD_DESCRIPCION}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">Nº ARTICULO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nArticulo" name="nArticulo" value="{{$producto->PROD_N_ARTICULO}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">DIAMETRO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="diametro" name="diametro" value="{{$producto->PROD_DIAMETRO}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class=" col-3 col-form-label text-right">LONGITUD:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="longitud" name="longitud" value="{{$producto->PROD_LONGITUD}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">TIPO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="tp" name="tp" value="{{$tipoImplante}}">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">CODIGO COLOR:</label>
          <div class="col-9">
              <input type="text" class="form-control" id="clc" name="clc"  value="{{$color}}">
          </div>
        </div>
        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">TIPO DE CONEXION:</label>
          <div class="col-9">

                <input type="text" class="form-control" id="tpc" name="tpc" value="{{$tipoConexion}} {{$tipoConexionDiametro}}">

          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label text-right">UDI 01:</label>
          <div class="col-9">
              <input type="text" class="form-control" id="udi01" name="udi01" value="{{$producto->PROD_UDI_01}}">
          </div>
        </div>



      </div>

    <!-- </form> -->

@endsection
