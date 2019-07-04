<?php

use Faker\Generator as Faker;
use App\Lead;

$factory->define(Lead::class, function (Faker $faker) {
    $created_at = $faker->dateTimeBetween('-4 weeks', 'now');
    $status_id = rand(1, 6);
    return [
        'name'   => $faker->name,
        'email'  => $faker->email,
        'phone'  => "(11) 1111-1111",
        'cell'   => "(11) 11111-1111",
        'city'   => "lorem ipsum",
        'state'  => "lorem ipsum",
        'tenant_id' => 1,
        'status_id'  => $status_id,
        'created_at' => $created_at,
    ];
});