<?php

use Illuminate\Database\Seeder;

class IMPLEMENTOS_USADOS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>1,
        'IUC_FECHA_DE_USO'=>'2018-04-29',
        'IUC_PD_COD'=>14,
        'IUC_CIR_COD'=>1,
        'IUC_ART_COD'=>12,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>2,
        'IUC_FECHA_DE_USO'=>'2018-05-29',
        'IUC_PD_COD'=>6,
        'IUC_CIR_COD'=>2,
        'IUC_ART_COD'=>23,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>3,
        'IUC_FECHA_DE_USO'=>'2018-06-04',
        'IUC_PD_COD'=>5,
        'IUC_CIR_COD'=>3,
        'IUC_ART_COD'=>49,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>4,
        'IUC_FECHA_DE_USO'=>'2018-06-04',
        'IUC_PD_COD'=>6,
        'IUC_CIR_COD'=>3,
        'IUC_ART_COD'=>49,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>5,
        'IUC_FECHA_DE_USO'=>'2018-06-06',
        'IUC_PD_COD'=>22,
        'IUC_CIR_COD'=>4,
        'IUC_ART_COD'=>25,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>6,
        'IUC_FECHA_DE_USO'=>'2018-05-24',
        'IUC_PD_COD'=>6,
        'IUC_CIR_COD'=>5,
        'IUC_ART_COD'=>25,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>7,
        'IUC_FECHA_DE_USO'=>'2018-05-28',
        'IUC_PD_COD'=>4,
        'IUC_CIR_COD'=>6,
        'IUC_ART_COD'=>36,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>8,
        'IUC_FECHA_DE_USO'=>'2018-05-28',
        'IUC_PD_COD'=>30,
        'IUC_CIR_COD'=>7,
        'IUC_ART_COD'=>15,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );



        App\IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS::create( [
        'UIC_COD'=>9,
        'IUC_FECHA_DE_USO'=>'2018-05-29',
        'IUC_PD_COD'=>1,
        'IUC_CIR_COD'=>8,
        'IUC_ART_COD'=>50,
        'created_at'=>NULL,
        'updated_at'=>NULL
        ] );

    }
}
