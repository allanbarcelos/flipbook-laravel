<?php

use Faker\Generator as Faker;

$factory->define(App\Cpf::class, function (Faker $faker) {
    return [
        'cpf' => $faker->unique()->cpf,
    ];
});
