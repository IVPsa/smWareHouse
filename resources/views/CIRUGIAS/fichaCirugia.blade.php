@extends('layouts.app')
@section('content')

<h3 class="text-center">CIRUGIA ID: {{$fichaCirugia->CIR_COD}}</h3>


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
              <textarea name="name" class="form-control"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <div class="offset-6 col-6">
              <button type="submit" class="btn btn-success btn-lg">ACTUALIZAR</button>
            </div>

          </div>

      </div>

    </form>

@endsection
