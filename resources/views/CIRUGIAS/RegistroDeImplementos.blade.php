@extends('layouts.app')
@section('content')
@include('layouts.messages')

<h3 class="text-center">Implemenentos Usados Para la cirugia</h3>

<form action="{{route('registarrImplementosAusar' ,$fichaCirugia->CIR_COD)}}" method="post"   class="form-group row">


      <div class="container"  >
        @csrf
        <div class="form-group row">
            <label for="last_name" class=" col-12 col-form-label ">DIENTE:</label>
            <div class="col-12">
              <select class="form-control" name="piezaDental">
                @foreach ( $piezasDentales as $piezasDentales)
                  <option value="{{$piezasDentales->PD_COD}}"> {{$piezasDentales->PD_SECTOR}} - {{$piezasDentales->PD_N_DIENTE}} - {{$piezasDentales->PD_NOMBRE}} </option>
                @endforeach

              </select>
            </div>
            <!-- <div class="col-6">
            <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
          </div> -->
        </div>


        <div class="form-group row">
          <label for="last_name" class=" col-12 col-form-label ">ARTICULO A EMPLEAR EN EL DIENTE:</label>
          <div class="col-12">
            <select class="form-control" name="implante">
              @foreach ( $articulos as $articulos)
                <option value="{{$articulos->ART_COD}}">
                  {{$articulos->PROD_UDI_01}} -
                  LOTE: {{$articulos->ART_LOTE}} -
                  FV: {{$articulos->ART_FECHA_EXP}} -
                  {{$articulos->PROD_NOMBRE}} -
                  {{$articulos->PROD_N_ARTICULO}} -
                  {{$articulos->PROD_DIAMETRO}}∅ -
                  {{$articulos->TC_DES}}-
                  {{$articulos->TI_DES}}-
                  {{$articulos->CLC_COLOR}}
                </option>
              @endforeach
            </select>
          </div>

        </div>

        <div class="form-group row">
          <div class="offset-5 col-7">
            <button type="submit" class="btn btn-success btn-lg">INGRESAR</button>
          </div>

        </div>

      </div>
</form>


<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="table-responsive" >
      <table class="table table-bordered table-hover  table-striped" align="center"  id="table">
          <thead class="thead-dark">
              <tr>
                <th>PIEZA</th>
                <th>ARTICULO</th>
                <th>NOMBRE</th>
                <th>LONGITUD</th>
                <th>DIAMETRO</th>
                <th>LOTE</th>
                <th>FECHA DE EXP.</th>



              </tr>
          </thead>



      </table>
    </div>

  </div>
</div>


@endsection
