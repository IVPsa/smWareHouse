@extends('layouts.app')
@section('content')

<h3 class="text-center display-3">CIRUGIA ID: {{$fichaCirugia->CIR_COD}}</h3>


@if($comprobacionDeEstado=="REALIZADA")

      <div class="container"  >



              <div class="form-group row">
                  <label for="last_name" class=" col-3 col-form-label text-right">NOMBRE DEL PACIENTE:</label>
                  <div class="col-9">
                    <input type="text"   maxlength="16" class="form-control" id="nombrePaciente" name="nombrePaciente"  value="{{$fichaCirugia->CIR_NOMBRE_PACIENTE}}" readonly>
                  </div>
              </div>


              <div class="form-group row">
                  <label  for="first_name" class="col-3 col-form-label text-right">RUT DEL PACIENTE:</label>
                  <div class="col-9 " >
                    <input type="text" class="form-control" id="rut" name="rut" value="{{$fichaCirugia->CIR_RUT_PACIENTE}}"  readonly>
                  </div>
              </div>

              <div class="form-group row">
                  <label  for="first_name" class="col-3 col-form-label text-right">FECHA DE LA CIRUGIA:</label>
                  <div class="col-9 " >
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{$fichaCirugia->CIR_FECHA}}"  readonly>
                  </div>
              </div>

              <div class="form-group row">
                <label  for="lote" class="col-3 col-form-label text-right">DESCRIPCION  :</label>
                <div class="col-9 " >
                  <textarea name="name" class="form-control" readonly>{{($fichaCirugia->CIR_DESCRIPCION)}}</textarea>
                </div>
              </div>



              <div class="form-group row">
                  <label  for="ESTADO" class="col-3 col-form-label text-right">ESTADO:</label>
                  <div class="col-9 " >
                    <input type="text" class="form-control" id="ESTADO" name="ESTADO" value="{{$fichaCirugia->CIR_ESTADO}}" readonly>
                  </div>
              </div>

          </div>
@else
 <form action="{{route('actualizarCirugia', $fichaCirugia->CIR_COD )}}" method="post"   class="form-group row">

   <div class="container"  >
     @csrf
     @method('patch')
              <div class="form-group row">
                  <label for="last_name" class=" col-3 col-form-label text-right">NOMBRE DEL PACIENTE:</label>
                  <div class="col-9">
                    <input type="text"   maxlength="16" class="form-control" id="nombrePaciente" name="nombrePaciente"  value="{{$fichaCirugia->CIR_NOMBRE_PACIENTE}}" required>
                  </div>
                  <!-- <div class="col-6">
                  <input type="text"   maxlength="16" class="form-control" id="udi01" name="udi01">
                </div> -->
              </div>


              <div class="form-group row">
                  <label  for="first_name" class="col-3 col-form-label text-right">RUT DEL PACIENTE:</label>
                  <div class="col-9 " >
                    <input type="text" class="form-control" id="rut" name="rut" value="{{$fichaCirugia->CIR_RUT_PACIENTE}}"  required>
                  </div>
              </div>

              <div class="form-group row">
                  <label  for="first_name" class="col-3 col-form-label text-right">FECHA DE LA CIRUGIA:</label>
                  <div class="col-9 " >
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{$fichaCirugia->CIR_FECHA}}"  required>
                  </div>
              </div>

              <div class="form-group row">
                <label  for="lote" class="col-3 col-form-label text-right">DESCRIPCION  :</label>
                <div class="col-9 " >
                  <textarea name="descripcion" class="form-control">{{($fichaCirugia->CIR_DESCRIPCION)}}</textarea>
                </div>
              </div>

              <div class="form-group row">
                <label  for="lote" class="col-3 col-form-label text-right">ESTADO:</label>
                <div class="col-9 " >
                  <select class="form-control" name="estado">
                    <option value="{{($fichaCirugia->CIR_ESTADO)}}">{{($fichaCirugia->CIR_ESTADO)}}</option>
                    <option value="REALIZADA">REALIZADA</option>
                    <option value="EN ESPERA">EN ESPERA</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="offset-6 col-6">
                  <button type="submit" class="btn btn-success btn-lg">ACTUALIZAR</button>
                </div>
              </div>



      </div>

    </form>
@endif
@endsection
