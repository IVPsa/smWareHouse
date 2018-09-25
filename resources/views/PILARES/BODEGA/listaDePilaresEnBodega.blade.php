@extends('layouts.app')
@section('content')
@include('layouts.messages')
@include('layouts.messages')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h3 class="text-center display-3">Lista de Pilares En Bodega</h3>

<div class="container"   ng-app="">
  @csrf

  <div class="form-group row">
    <label  for="first_name" class="col-md-2 col-xs-12 col-form-label text-right">BUSCAR POR:</label>
    <div class="col-md-4 col-xs-12" >
      <form>
        <select  class="form-control"ng-model="myVar">
          <option value="" selected >Seleccionar</option>
          <option value="LOTE">LOTE</option>
          <option value="FechaExp">FECHA EXP.</option>
          <option value="TIPO">TIPO</option>
          <option value="UDI">UDI</option>
        </select>
      </form>
    </div>

    <div class="col-md-6 col-xs-12" >
        <div ng-switch="myVar">

              @csrf
              <div ng-switch-when="LOTE">
                <form class="" action="{{route('buscarArticulo')}}" method="get">
                  <input type="text" hidden value="LOTE"  name="condicion"/>
                  <div class="form-group row">

                        <input type="text" maxlength="6" class="form-control col-md-11 col-xs-12" name="lote" required>

                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>

              <div ng-switch-when="FechaExp">
                <form class="" action="{{route('buscarArticulo')}}" method="get">
                  <input type="text" hidden value="fechaExp"  name="condicion"/>
                  <div class="form-group row">
                        <input type="date" class="form-control col-md-11 col-xs-12" name="FechaExp" required>

                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>





              <div ng-switch-when="TIPO">
                <form class="" action="{{route('buscarArticulo')}}" method="get">
                  <input type="text" hidden value="TIPO"  name="condicion"/>
                  <div class="form-group row">
                        <select class="form-control col-md-11 col-xs-12" name="tipoImplante">

                        </select>
                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>


              <div ng-switch-when="UDI">
                <form class="" action="{{route('buscarArticulo')}}" method="get">
                  <input type="text" hidden value="UDI"  name="condicion"/>
                  <div class="form-group row">
                      <input type="text"   maxlength="16" class="form-control col-md-11 col-xs-12" id="udi01" name="udi01">

                      <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
               </form>
              </div>


        </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>LONGITUD</th>
                <th>DIAMETRO</th>
                <th>TIPO CONEXION</th>
                <th>TIPO DE IMPLANTE</th>
                <th>COLOR</th>
                <th>FECHA EXP</th>
                <th>LOTE</th>
                <th>CANT</th>

                <th width="100px" colspan="3" >ACCION</th>
              </tr>
          </thead>

          <tr>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td></td>
            <td> </td>
            <td></td>


            <td width="15px" >
               <a href="" >
                  <button class="btn btn-lg btn-success"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Agregar Existencias">
                    <i class="material-icons" >library_add</i>
                  </button>
               </a>
            </td>
            <td width="15px" >
              <a href="{{route('fichaDePilares')}}">
                <button class="btn btn-lg btn-info"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha Del Pilar En Catalogo">
                  <i class="fa fa-clipboard" ></i>
                 </button>
              </a>
            </td>
            <td width="15px" >
              <a href="">
                <button class="btn btn-lg btn-warning"  style="width:50px; height:50px;" data-toggle="tooltip" data-placement="top" title="Ver Ficha Del Pilar en Inventario">
                  <i class="material-icons">content_copy</i>
                 </button>
              </a>
            </td>

          </tr>



      </table>
    </div>


  </div>
</div>

@endsection
