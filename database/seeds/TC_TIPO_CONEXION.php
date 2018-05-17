<?php

use Illuminate\Database\Seeder;

class TC_TIPO_CONEXION extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\TC_TIPO_CONEXION::create(['TC_DES'=>'NNC: Narrow Neck CrossFit®','TC_DIAMETRO'=>'3.5 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'RN: Regular Neck','TC_DIAMETRO'=>'4.8 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'WN: Wide Neck','TC_DIAMETRO'=>'6.5 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'SC: Small CrossFit','TC_DIAMETRO'=>'2.9 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'NC: Narrow CrossFit','TC_DIAMETRO'=>'3.3 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'RC: Regular CrossFit','TC_DIAMETRO'=>'4.1 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'RC: Regular CrossFit','TC_DIAMETRO'=>'4.8 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'ND: Narrow Diameter','TC_DIAMETRO'=>'3.5 mm']);
        App\TC_TIPO_CONEXION::create(['TC_DES'=>'RD: Regular Diameter','TC_DIAMETRO'=>'4.8 mm']);
    }
}
