<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'cep' => $faker->postcode,
        'logradouro'=> $faker->streetAddress,
        'bairro'=> "Bairro " . $faker->city,
        'complemento' => $faker->secondaryAddress,
        'cidade'=> $faker->city,
        'uf' => $faker->stateAbbr
    ];
});
