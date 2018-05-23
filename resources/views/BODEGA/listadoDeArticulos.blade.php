@extends('layouts.app')

@section('content')




<h3 class="text-center">Lista De Productos</h3>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>UDI</th>
                <th>LOTE</th>
                <th>FECHA EXP</th>
                <th>CANT</th>
                <!-- <th width="100px">CLC</th> -->
                <th width="100px" colspan="2">ACCION</th>
              </tr>
          </thead>
        @foreach($listadoDeArticulos as $lista)
          <tr>
            <td>{{ $lista->ART_COD }}</td>
            <td>{{ $lista->ART_UDI }}</td>
            <!-- <td>{{ $lista->ART_PROD_COD }}</td> -->
            <td>{{ $lista->ART_FECHA_EXP }}</td>
            <td>{{ $lista->ART_LOTE }}</td>
            <td>{{ $lista->ART_CANT }}</td>


            <td width="15px" >
               <a href="#" >
                  <button class="btn btn-lg btn-success" id="agregar">
                     <i class="fa fa-play"></i>
                  </button>
               </a>
            </td>
            <td width="15px" >
                <button type="button"  class="btn btn-lg btn-danger" id="eliminar">
                  <i class="fa fa-remove"></i>
                </button>
            </td>
          </tr>
        @endforeach


      </table>
    </div>
  {{ $listadoDeArticulos->links() }}
  </div>
</div>

@endsection
