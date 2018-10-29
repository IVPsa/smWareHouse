@extends('layouts.app')
@section('content')
@include('layouts.messages')
<h1 class="text-center display-3">Ingresar Pilar por codigo</h1>


    <form action="{{route('insertPilares')}}" method="post"   class="form-group row">

      <div class="container"  >
        @csrf
        <div class="form-group row">
            <label for="last_name" class=" col-3 col-form-label text-right">UDI (01):</label>
            <div class="col-9">
              <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01" >
            </div>
            <!-- <div class="col-6">
            <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
          </div> -->
        </div>


        <div class="form-group row">
            <label  for="first_name" class="col-3 col-form-label text-right">UDI COMPLETA:</label>
            <div class="col-9 " >
              <input type="text"  maxlength="31" class="form-control" id="udi" name="udi"  required>
            </div>

        </div>

        <div class="form-group row">
          <label  for="lote" class="col-3 col-form-label text-right">LOTE:</label>
          <div class="col-9 " >
            <input type="text" class="form-control" id="lote" name="lote"  required>
          </div>
        </div>

        <div class="form-group row">
          <label  for="cantidad" class="col-3 col-form-label text-right">CANTIDAD:</label>
          <div class="col-9 " >
            <input type="number" min="1" value="1" class="form-control" id="cantidad" name="cantidad"  required>
          </div>
        </div>

        <div class="form-group row">
          <div class="offset-3 col-9">
            <button type="submit" class="btn btn-success btn-lg">INGRESAR</button>
          </div>

        </div>

      </div>
    </form>


@endsection
