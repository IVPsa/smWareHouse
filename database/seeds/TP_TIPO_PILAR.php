<?php

use Illuminate\Database\Seeder;

class TP_TIPO_PILAR extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Tissue Level NNC' ]);
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Tissue Level RN' ]);
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Tissue Level WN' ]);
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Bone Level SC' ]);
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Bone Level NC' ]);
        App\TP_TIPO_PILAR::create(['TP_DESC' => 'Bone Level RC' ]);
    }
}
