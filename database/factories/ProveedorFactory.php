<?php

use Faker\Generator as Faker;

$factory->define(App\Proveedor::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(10, 1500),
        'nombre' => $faker->name,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'correo' => $faker->email,
    ];
});
