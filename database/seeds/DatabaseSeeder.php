<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 1)->create();
        $this->call(TI_TIPO_IMPLANTE::class);
        $this->call(CLC_COLOR_CODING::class);
        $this->call(TC_TIPO_CONEXION::class);
        $this->call(PRO_PRODUCTOS::class);
        $this->call(PD_PIEZAS_DENTALES::class);
        $this->call(ART_ARTICULOS::class);

        // factory(App\ART_ARTICULOS::class, 1)->create();
        // factory(App\CIR_CIRUGIA::class, 1)->create();

        // //SEEDERS TESTS
        //
        // // factory(App\User::class, 10)->create();
        //
        // factory(App\ART_ARTICULOS::class, 10)->create();
        // factory(App\CIR_CIRUGIA::class, 10)->create();

    }
}
