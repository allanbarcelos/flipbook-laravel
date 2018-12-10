<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'cep' => $faker->postcode,
        'logradouro'=> $faker->streetAddress,
        'bairro'=> $faker->neighborhood,
        'complemento' => $faker->secondaryAddress,
        'cidade'=> $faker->city,
        'uf' => $faker->stateAbbr
    ];
});
