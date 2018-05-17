<?php

use Illuminate\Database\Seeder;

class TI_TIPO_IMPLANTE extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\TI_TIPO_IMPLANTE::create(['TI_DES'=>'TL','TI_CLASE' => 'S-Standard Implant' ]);
        App\TI_TIPO_IMPLANTE::create(['TI_DES'=>'TL','TI_CLASE' => 'SP-Standard Plus Implant']);
        App\TI_TIPO_IMPLANTE::create(['TI_DES'=>'TL','TI_CLASE' => 'TE-Tapered Effect Implant' ]);

        App\TI_TIPO_IMPLANTE::create(['TI_DES'=>'BL','TI_CLASE' => 'BL-Bone Level Implant' ]);
        App\TI_TIPO_IMPLANTE::create(['TI_DES'=>'BL','TI_CLASE' => 'BLT-Bone Level Tapered Implant' ]);



        // App\TI_TIPO_IMPLANTE::create(
        //   ['TI_DES'=>'TL','TI_CLASE' => 'S-Standard Implant' ],
        //   ['TI_DES'=>'TL','TI_CLASE' => 'SP-Standard Plus Implant' ],
        //   ['TI_DES'=>'TL','TI_CLASE' => 'TE-Tapered Effect Implant' ],
        //
        //   ['TI_DES'=>'BL','TI_CLASE' => 'BL-Bone Level Implant' ],
        //   ['TI_DES'=>'BL','TI_CLASE' => 'BLT-Bone Level Tapered Implant' ]
        //
        //
        // );

    }
}
