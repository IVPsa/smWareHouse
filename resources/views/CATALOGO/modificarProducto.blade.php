@extends('layouts.app')
@section('content')
<h3 class="text-center">Crear Nuevo Producto</h3>
    <form action="{{route('nuevoProducto')}}" method="post"   class="form-group row">

      <div class="container"  >
        @csrf

        <div class="form-group row">

          <label  for="first_name" class="  col-3 col-form-label">NOMBRE:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nompreProducto" name="nompreProducto"  required>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">DESCRIPCION:</label>
          <div class="col-9">
            <select  class="form-control" id="descProducto" name="descProducto" required>
                    <option value="Implante no Guiado">Implante Guiado</option>
                    <option value="Implante no Guiado">Implante no Guiado</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">Nº ARTICULO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nArticulo" name="nArticulo" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">DIAMETRO:</label>
          <div class="col-9">
            <select  class="form-control" id="diametro" name="diametro" required>
              <option value="">Seleccione </option>
              <option value="2.9mm">2.9mm Ø </option>
              <option value="3.3mm">3.3mm Ø </option>
              <option value="4.1mm">4.1mm Ø </option>
              <option value="4.8mm">4.8mm Ø </option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class=" col-3 col-form-label">LONGITUD:</label>
          <div class="col-9">
            <select class="form-control " id="longitud" name="longitud"  required>
              <option value=""> Seleccione</option>
              <option value="8mm"> 8mm</option>
              <option value="10mm"> 10mm</option>
              <option value="12mm"> 12mm</option>
              <option value="14mm"> 14mm</option>
              <option value="14mm"> 16mm</option>
              <option value="18mm"> 18mm</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">TIPO:</label>
          <div class="col-9">
            <select class="form-control" name="tp" >
              <option value="" selected> Seleccione</option>
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
              <option value="" selected> Seleccione</option>
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
              <option value="" selected> Seleccione</option>
              @foreach ($tipoConexion as $tipoConexiones)
              <option value="{{$tipoConexiones->TC_COD}}" >{{$tipoConexiones->TC_DES}} - {{$tipoConexiones->TC_DIAMETRO}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="last_name" class=" col-3 col-form-label">UDI (01):</label>
          <div class="col-9">
            <input type="text"   maxlength="17" class="form-control" id="udi01" name="udi01">
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
