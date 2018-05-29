@extends('layouts.app')
@section('content')
<h3 class="text-center">CIRUGIAS</h3>
<div class="row">
  <div class="col-md-12">
    <div class="row">


      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('listaDeCirugias')}}"><button type="button" class="btn btn-success btn-lg">Lista De cirugias</button></a>
        <br>
      </div>

      <div class="col-md-6 col-sm-12" align="center">
        <a href="{{route('ShowRegistrarCirugia')}}"><button type="button" class="btn btn-success btn-lg ">Registrar Cirugia</button></a>
        <br>
      </div>

    </div>
  </div>

</div>


@endsection
