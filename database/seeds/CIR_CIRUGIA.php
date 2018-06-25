<?php

use Illuminate\Database\Seeder;

class CIR_CIRUGIA extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>1,
        'CIR_NOMBRE_PACIENTE'=>'Dayana Reus',
        'CIR_RUT_PACIENTE'=>'15.520.735-6',
        'CIR_DESCRIPCION'=>'cirugia guiada',
        'CIR_FECHA'=>'2018-04-29',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:15:30',
        'updated_at'=>'2018-06-23 02:09:01'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>2,
        'CIR_NOMBRE_PACIENTE'=>'Eliana Buchner',
        'CIR_RUT_PACIENTE'=>'7.726.789-1',
        'CIR_DESCRIPCION'=>'cirugia guiada',
        'CIR_FECHA'=>'2018-05-29',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:17:20',
        'updated_at'=>'2018-06-23 01:17:20'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>3,
        'CIR_NOMBRE_PACIENTE'=>'Cecilia Estay',
        'CIR_RUT_PACIENTE'=>'8.760.206-0',
        'CIR_DESCRIPCION'=>'cirugia guiada 2 piezas',
        'CIR_FECHA'=>'2018-06-04',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:20:44',
        'updated_at'=>'2018-06-23 01:20:44'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>4,
        'CIR_NOMBRE_PACIENTE'=>'Sonia Benavides',
        'CIR_RUT_PACIENTE'=>'8.074.562-1',
        'CIR_DESCRIPCION'=>'Cirugia Guiada',
        'CIR_FECHA'=>'2018-06-06',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:22:37',
        'updated_at'=>'2018-06-23 01:22:37'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>5,
        'CIR_NOMBRE_PACIENTE'=>'Roberto Paineñonco',
        'CIR_RUT_PACIENTE'=>'11.246.994-k',
        'CIR_DESCRIPCION'=>'cirugia',
        'CIR_FECHA'=>'2018-05-24',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:41:15',
        'updated_at'=>'2018-06-23 01:41:15'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>6,
        'CIR_NOMBRE_PACIENTE'=>'Karen Retamal',
        'CIR_RUT_PACIENTE'=>'14.221.830-5',
        'CIR_DESCRIPCION'=>'cirugia',
        'CIR_FECHA'=>'2018-05-28',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:43:16',
        'updated_at'=>'2018-06-23 01:43:16'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>7,
        'CIR_NOMBRE_PACIENTE'=>'Beatriz Bizcarra',
        'CIR_RUT_PACIENTE'=>'6.992.611-8',
        'CIR_DESCRIPCION'=>'cirugia',
        'CIR_FECHA'=>'2018-05-28',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>'2018-06-23 01:45:21',
        'updated_at'=>'2018-06-23 01:45:21'
        ] );

        App\CIR_CIRUGIA::create( [
        'CIR_COD'=>8,
        'CIR_NOMBRE_PACIENTE'=>'Manuel Reyes ',
        'CIR_RUT_PACIENTE'=>'15.446.796-3',
        'CIR_DESCRIPCION'=>'cirugia ',
        'CIR_FECHA'=>'2018-05-29',
        'CIR_ESTADO'=>'REALIZADA',
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );
    }
}
