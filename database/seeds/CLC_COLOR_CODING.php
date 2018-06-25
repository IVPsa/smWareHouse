<?php

use Illuminate\Database\Seeder;

class CLC_COLOR_CODING extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\CLC_COLOR_CODING::create(['CLC_COLOR'=>'blue','CLC_DESC' => 'Endosteal implant diameter 2.9 mm' ]);
        App\CLC_COLOR_CODING::create(['CLC_COLOR'=>'yellow','CLC_DESC' => 'Endosteal implant diameter 3.3 mm' ]);
        App\CLC_COLOR_CODING::create(['CLC_COLOR'=>'red','CLC_DESC' => 'Endosteal implant diameter 4.1 mm']);
        App\CLC_COLOR_CODING::create(['CLC_COLOR'=>'green','CLC_DESC' => 'Endosteal implant diameter 4.8 mm ']);
    }
}
