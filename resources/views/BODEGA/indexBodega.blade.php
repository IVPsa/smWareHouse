@extends('layouts.app')
@section('content')
@include('layouts.messages')

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<h1 class="display-3 text-center">BODEGA</h1>

<div class="row">
  <div class="col-md-12">
      <div class="row">
        <div class="col-md-6   col-xs-12" align="center">
          <a href="{{route('IndexBodegaImplantes')}}">
            <button type="button" class="btn btn-primary btn-lg" style="width:240px; height:200px;">
              <i class="fa fa-archive" style="font-size:150px; width:202px;"></i>
              <br />
              Implantes
            </button>
          </a>
        </div>

        <div class="col-md-6 col-xs-12" align="center">
          <a href="{{route('IndexBodegaPilares')}}">
            <button type="button" class="btn btn-danger btn-lg" style="width:240px; height:200px;">
              <i class="fa fa-archive" style="font-size:150px; width:202px;"></i>
              <br />
              Pilares
            </button>
          </a>
        </div>




      </div>

    </div>
  </div>

  <br />
  <br />

@endsection
