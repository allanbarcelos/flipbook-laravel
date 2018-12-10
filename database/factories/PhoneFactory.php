<?php

use Faker\Generator as Faker;

$factory->define(App\Phone::class, function (Faker $faker) {

    $options = $faker->randomElement(array(
        ['cellphone', $faker->cellphoneNumber],
        ['landline', $faker->landlineNumber],
    ));

    return [
        'phone' => $options[1],
        'type' => $options[0],
    ];
});
