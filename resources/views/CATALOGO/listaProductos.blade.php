@extends('layouts.app')
@section('content')
@include('layouts.messages')
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('#Eliminar').tooltip();
});
</script>
<h3 class="text-center display-3">Lista De Productos</h3>

<div class="container"   ng-app="">
  @csrf

  <div class="form-group row">
    <label  for="first_name" class="col-md-2 col-xs-12 col-form-label text-right">BUSCAR POR:</label>
    <div class="col-md-4 col-xs-12" >
      <form>
        <select  class="form-control"ng-model="myVar">
          <option value="" selected >Seleccionar</option>
          <option value="DIAMETRO">DIAMETRO</option>
          <option value="LARGO">LARGO</option>
          <option value="TIPO">TIPO</option>
          <option value="COLOR">COLOR</option>
          <option value="UDI">UDI</option>

        </select>
      </form>
    </div>

    <div class="col-md-6 col-xs-12" >
        <div ng-switch="myVar">

              @csrf
              <div ng-switch-when="DIAMETRO">
                <form class="" action="{{route('buscarProducto')}}" method="get">
                  <input type="text" hidden value="DIAMETRO"  name="condicion"/>
                  <div class="form-group row">

                        <select class="form-control col-md-11 col-xs-12" name="diametro" required>
                          <option value="">Seleccionar</option>
                          <option value="2.9mm">2.9mm</option>
                          <option value="3.3mm">3.3mm</option>
                          <option value="4.1mm">4.1mm</option>
                          <option value="4.8mm">4.8mm</option>
                        </select>
                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                    </div>
                  </form>
              </div>

              <div ng-switch-when="LARGO">
                <form class="" action="{{route('buscarProducto')}}" method="get">
                  <input type="text" hidden value="LARGO"  name="condicion"/>
                  <div class="form-group row">
                        <select class="form-control col-md-11 col-xs-12" name="largo">
                          <option value="8mm">8mm</option>
                          <option value="10mm">10mm</option>
                          <option value="12mm">12mm</option>
                        </select>

                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>

              <div ng-switch-when="TIPO">
                <form class="" action="{{route('buscarProducto')}}" method="get">
                  <input type="text" hidden value="TIPO"  name="condicion"/>
                  <div class="form-group row">
                        <select class="form-control col-md-11 col-xs-12" name="tipoImplante">
                          @foreach ($tipoImplante as $tipoImplante)
                          <option value="{{$tipoImplante->TI_COD}}">{{$tipoImplante->TI_CLASE}}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>

              <div ng-switch-when="COLOR">
                <form class="" action="{{route('buscarProducto')}}" method="get">
                  <input type="text" hidden value="COLOR"  name="condicion"/>
                  <div class="form-group row">
                        <select  class="form-control col-md-11 col-xs-12" name="color">
                          @foreach ($color as $color)
                            <option value="{{$color->CLC_COD}}">{{$color->CLC_COLOR}}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-lg  btn-success col-md-1"> <i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>

              <div ng-switch-when="UDI">
                <form class="" action="{{route('buscarProducto')}}" method="get">
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
              <th>DESCRIPCION</th>
              <th>Nº Art.</th>
              <th width="100px">LONGITUD</th>
              <th width="100px">DIAMETRO</th>
              <th width="100px">UDI(01)</th>
              <th width="100px" colspan="3">ACCION</th>
            </tr>
        </thead>
        @foreach($listaDeProductos as $lista)
        <tr>
          <td>{{ $lista->PROD_COD }}</td>
          <td>{{ $lista->PROD_NOMBRE }}</td>
          <td>{{ $lista->PROD_DESCRIPCION }}</td>
          <td>{{ $lista->PROD_N_ARTICULO }}</td>
          <td>{{ $lista->PROD_LONGITUD }}</td>
          <td>{{ $lista->PROD_DIAMETRO   }}</td>
          <td>{{ $lista->PROD_UDI_01    }}</td>
          <!-- <td>{{ $lista->PROD_CLC_COD    }}</td> -->
          <td width="15px" >
            <a href="{{route('fichaDeProducto', $lista->PROD_COD)}}">
              <button class="btn btn-lg btn-info" data-toggle="tooltip" data-Placement="top" title="Ver Ficha De Producto" >
                <i class="fa fa-clipboard" ></i>
              </button>
            </a>
          </td>

          <td width="15px" >
            <a href="{{route('borrarPoducto', $lista->PROD_COD)}}">
                <button type="button"  class="btn btn-lg btn-danger"  data-toggle="tooltip" data-Placement="top"  title="Eliminar Producto" id="Eliminar"><i class="fa fa-remove"></i></button>
            </a>
          </td>

        </tr>
       @endforeach


</table>
</div>
{{ $listaDeProductos->links() }}
</div>
</div>

@endsection
