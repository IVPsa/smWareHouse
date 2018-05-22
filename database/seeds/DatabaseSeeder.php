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
        // $this->call(UsersTableSeeder::class);
        $this->call(TI_TIPO_IMPLANTE::class);
        $this->call(CLC_COLOR_CODING::class);
        $this->call(TC_TIPO_CONEXION::class);
        $this->call(PRO_PRODUCTOS::class);
    }
}
