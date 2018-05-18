@extends('layouts.app')
@section('content')
<h3 class="text-center">Crear Nuevo Producto</h3>
    <form action="{{route('nuevoProducto')}}" method="post"   class="form-group row">

      <div class="container"  >
        @csrf

        <div class="form-group row">

          <label  for="first_name" class="  col-3 col-form-label">NOMBRE:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nompreProducto" name="nompreProducto">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">DESCRIPCION:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="descProducto" name="descProducto">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">Nº ARTICULO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nArticulo" name="nArticulo">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">DIAMETRO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="diametro" name="diametro">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class=" col-3 col-form-label">LONGITUD:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="longitud" name="longitud">
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">TIPO:</label>
          <div class="col-9">
            <select class="form-control" name="tp" >
              @foreach ($tipoImplante as $tipoImplantes)
              <option value="{{$tipoImplantes->TI_COD}}" > {{$tipoImplantes->TI_DES}}- {{$tipoImplantes->TI_CLASE}} </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">CODIGO COLOR:</label>
          <div class="col-9">
            <select class="form-control" name="clc" >
              @foreach($colorCoding as $colorCodings)
              <option value="{{$colorCodings->CLC_COD}}" >{{$colorCodings->CLC_COLOR}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">TIPO DE CONEXION:</label>
          <div class="col-9">
            <select class="form-control" name="tpc" >
              @foreach ($tipoConexion as $tipoConexiones)
              <option value="{{$tipoConexiones->TC_COD}}" >{{$tipoConexiones->TC_DES}} - {{$tipoConexiones->TC_DIAMETRO}}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="form-group row">
          <div class="offset-3 col-9">
            <button type="submit" class="btn btn-success btn-lg">CREAR</button>
          </div>

        </div>

      </div>
    </form>


@endsection
