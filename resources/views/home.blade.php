@extends('layouts.app')

@section('content')

                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">

                <h3 class="text-center">Bienvenido {{ Auth::user()->name }} a SM Ware House</h3>
                <br>

                <center>


                    <a href="{{route('catalogo')}}"><button type="button" class="btn btn-info"><i class="fa fa-clipboard" style="font-size:150px; width:202px;"></i> <br> CATALOGO</button></a>
                    <a href="{{route('indexBodega')}}"><button type="button" class="btn btn-warning"> <i class="fa fa-archive" style="font-size:150px; width:202px;"></i> <br> BODEGA</button></a>
                    <a href="{{route('Cirugias')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> CIRUGIAS</button></a>
                      <a href="{{route('pruebaLector')}}"><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> PRUEBA LECTOR</button></a>

                </center>

@endsection
