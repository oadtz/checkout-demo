<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'customer_name'         =>  $faker->name,
        'currency'              =>  'USD', //$faker->currencyCode,
        'amount'                =>  $faker->randomFloat(2, 1, 9000),
        'status'                =>  $faker->randomElement(['SUCCESS', 'FAILED'])
    ];
});
