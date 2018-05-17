@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">

                <h3>Bienvenido {{ Auth::user()->name }} a SM Ware House</h3>

                <center>

                    <a href=""><button type="button" class="btn btn-success"> <i class="fa fa-address-card-o" style="font-size:150px; width:202px;"></i> <br>PERFIL</button></a>
                    <a href=""><button type="button" class="btn btn-info"><i class="fa fa-clipboard" style="font-size:150px; width:202px;"></i> <br> CATALOGO</button></a>
                    <a href=""><button type="button" class="btn btn-warning"> <i class="fa fa-archive" style="font-size:150px; width:202px;"></i> <br> BODEGA</button></a>
                    <a href=""><button type="button" class="btn btn-dark"> <i class="fa fa-user-md" style="font-size:150px; width:202px;"></i> <br> CIRUGIAS</button></a>

                </center>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
