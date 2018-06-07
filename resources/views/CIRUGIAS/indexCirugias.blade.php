@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h1 class="text-center display-3">CIRUGIAS</h1>
<div class="row">
  <div class="col-md-12">
    <div class="row">


      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('listaDeCirugias')}}">
          <button type="button" class="btn btn-success btn-lg" style="width:240px; height:200px;">
            <i class="fa fa-medkit" style="font-size:150px; width:202px;"></i>
            <br>
            Lista De cirugias
          </button>
        </a>
        <br>
      </div>

      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('ShowRegistrarCirugia')}}">
          <button type="button" class="btn btn-success btn-lg ">
            <i class="fa fa-stethoscope" style="font-size:150px; width:202px;"></i>
            <br />
            Registrar Cirugia
          </button>
        </a>
        <br>
      </div>

    </div>
  </div>

</div>


@endsection
