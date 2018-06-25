@extends('layouts.app')
@section('content')

<h3 class="text-center">FICHA DEL ARTIUCLO ID:{{$Articulo->ART_COD}} </h3>

      <div class="container"  >
        <div class="form-group row">
            <label for="last_name" class=" col-3 col-form-label text-right">UDI (01):</label>
            <div class="col-9">
              <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01" readonly value="{{$udiProd}}">
            </div>
            <!-- <div class="col-6">
            <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
          </div> -->
        </div>


        <div class="form-group row">
            <label  for="first_name" class="col-3 col-form-label text-right">UDI COMPLETA:</label>
            <div class="col-9 " >
              <input type="text" class="form-control" id="udi" name="udi"  value="{{$Articulo->ART_UDI}}" readonly>
            </div>

        </div>

        <div class="form-group row">
          <label  for="lote" class="col-3 col-form-label text-right">LOTE:</label>
          <div class="col-9 " >
            <input type="text" class="form-control" id="lote" name="lote"  value="{{$Articulo->ART_LOTE}}" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label  for="fechaExp" class="col-3 col-form-label text-right">FECHA DE EXPIRACION:</label>
          <div class="col-9 " >
            <input type="date" class="form-control"  id="fechaExp" name="fechaExp" value="{{$Articulo->ART_FECHA_EXP}}" readonly    >
          </div>
        </div>

        <div class="form-group row">
          <label  for="cantidad" class="col-3 col-form-label text-right">CANTIDAD:</label>
          <div class="col-9 " >
            <input type="number" min="1" class="form-control" id="cantidad" name="cantidad"  value="{{$Articulo->ART_CANT}}" readonly>
          </div>
        </div>

      </div>





@endsection
