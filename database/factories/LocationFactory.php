<?php

use Faker\Generator as Faker;
use App\Location;

$factory->define(Location::class, function (Faker $faker) 
{
    $city = $faker->city;
    return [
        'name' => $city,
        'address_1' => $faker->streetName,
        'address_2' => $faker->secondaryAddress,
        'city' => $city,
        'state' => $faker->state,
        'postal_code' => $faker->postcode,
    ];
});