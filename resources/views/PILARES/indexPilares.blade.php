@extends('layouts.app')
@section('content')
@include('layouts.messages')

<h1 class="display-3 text-center">BODEGA DE PILARES</h1>

<div class="row">
  <div class="col-md-12">
      <div class="row">
        <div class="col-md-4   col-xs-12" align="center">
          <a href="{{route('ingresoDePilaresPorCodProd')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:145px; width:202px;">playlist_add</i>
              <br />
              Ingreso De Pilares
            </button>
          </a>
        </div>

        <div class="col-md-4 col-xs-12" align="center">
          <a href="{{route('listaDePilaresEnBodega')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="fa fa-list-ul" style="font-size:150px; width:202px;"></i>
              <br />
              Inventario de Pilares
            </button>
          </a>
        </div>

        <div class="col-md-4 col-xs-12" align="center">
          <a href="{{route('ImplementosUtilizados')}}">
            <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
              <i class="material-icons" style="font-size:150px; width:202px;">folder_open</i>
              <br />
              Implementos Pilares Usados
            </button>
            </a>
        </div>



      </div>

    </div>
  </div>

  <br />
  <br />

@endsection
