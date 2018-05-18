@extends('layouts.app')

@section('content')

<h3 class="text-center">Lista De Productos</h3>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover table-dark table-striped" align="center"  id="table">

        <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>DESCRIPCION</th>
              <th>ESTADO</th>
              <th width="100px">FECHA INICIO</th>
              <th width="100px">FECHA TERMINO</th>
              <th width="100px" colspan="2">ACCION</th>
            </tr>
        </thead>
        @foreach($listaDeProductos as $lista)
        <tr>
          <td>{{ $lista->PROD_COD }}</td>
          <td>{{ $lista->PROD_NOMBRE }}</td>
          <td>{{ $lista->PROD_DESCRIPCION }}</td>
          <td>{{ $lista->PROD_N_ARTICULO }}</td>
          <td>{{ $lista->PROD_LONGITUD }}</td>
          <td width="15px" ><button class="btn btn-lg btn-success"> <i class="fa fa-play"></i></button></td>
          <td width="15px" >

              <button type="button"  class="btn btn-lg btn-danger"><i class="fa fa-remove"></i></button>

          </td>
        </tr>
       @endforeach


</table>
</div>
{{ $listaDeProductos->links() }}
</div>
</div>

@endsection
