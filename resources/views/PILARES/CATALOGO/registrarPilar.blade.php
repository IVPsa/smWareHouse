@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h1 class="text-center display-3">Registrar Nuevo Pilar</h1>
    <form action="" method="post"   class="form-group row">

      <div class="container"  >
        @csrf

        <div class="form-group row">

          <label  for="first_name" class="  col-3 col-form-label">NOMBRE:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nombreProducto" name="nombrePilar"  required>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">DESCRIPCION:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="pilarDescripcion" name="pilarDescripcion"  required>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">Nº ARTICULO:</label>
          <div class="col-9">
            <input type="text" class="form-control" id="nArticulo" name="nArticulo" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="last_name" class="col-3 col-form-label">TIPO:</label>
          <div class="col-9">
            <select  class="form-control" id="diametro" name="diametro" required>
              <option value="">Seleccione </option>
              <option value="Tissue Level NNC">Tissue Level NNC </option>
              <option value="Tissue Level RN">Tissue Level RN</option>
              <option value="Tissue Level WN">Tissue Level WN</option>
              <option value="Bone Level SC">Bone Level SC</option>
              <option value="Bone Level NC">Bone Level NC</option>
              <option value="Bone Level RC">Bone Level RC</option>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label for="last_name" class=" col-3 col-form-label">UDI (01):</label>
          <div class="col-9">
            <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
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
