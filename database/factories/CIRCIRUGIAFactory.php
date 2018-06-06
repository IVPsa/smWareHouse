<?php

use Faker\Generator as Faker;

$factory->define(App\CIR_CIRUGIA::class, function (Faker $faker) {
    return [
        //
        'CIR_NOMBRE_PACIENTE'=> $faker->name(),
        'CIR_RUT_PACIENTE'=> ($faker->numberBetween($min = 30000000, $max = 21000000).$faker->randomLetter()),
        'CIR_FECHA'=> $faker->date($format = 'Y-m-d'),
        'CIR_DESCRIPCION'=>$faker->text($maxNbChars = 200),
        'CIR_ESTADO'=>'EN PROCESO'

    ];
});
