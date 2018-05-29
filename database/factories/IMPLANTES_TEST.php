<?php
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\ART_ARTICULOS::class, function (Faker $faker) {
    return [
      'ART_UDI' => ('0107630031730374'. $faker->date($format = 'Y-m-d', $max = 'now').'456789') ,
      'ART_PROD_COD' => 3,
      'ART_FECHA_EXP' =>  $faker->date($format = 'Y-m-d', $max = 'now'),
      'ART_LOTE' => '456789',
      'ART_CANT' =>$faker->numberBetween($min = 1, $max = 10),
      'updated_at'=> Carbon::now(),
      'created_at'=> Carbon::now()
    ];
});
