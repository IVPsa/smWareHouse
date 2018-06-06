@extends('layouts.app')
@section('content')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h3 class="text-center">Lista De articulos Usados</h3>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>FECHA DE USO</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>LOTE</th>
                <th>FECHA EXP</th>



                <th width="100px" colspan="2" >ACCION</th>

              </tr>
          </thead>
          @foreach($listaDeUsados as $lista)
          <tr>
              <td>{{$lista-> IUC_FECHA_DE_USO  }}</td>
              <td>{{$lista-> PROD_NOMBRE}}</td>
              <td>{{$lista-> PROD_DESCRIPCION}}</td>
              <td>{{$lista-> ART_LOTE}}</td>
              <td>{{$lista-> ART_FECHA_EXP}}</td>
              <td>
                <a href="{{route('fichaCirugia', $lista->IUC_CIR_COD)}}">
                  <button class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Ver ficha de la cirugia" >
                     <i class="fa fa-play"></i>
                  </button>
                </a>
              </td>
              <td>

              </td>
          </tr>
          @endforeach


      </table>
    </div>
    {{ $listaDeUsados->links() }}

  </div>
</div>

@endsection
