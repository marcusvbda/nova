<?php

use App\Location;
use Faker\Generator as Faker;
use App\Lead;

$factory->define(Lead::class, function (Faker $faker) {
    $location = Location::inRandomOrder()->first();

    // Create some time in last 4 weeks
    $created_at = $faker->dateTimeBetween('-4 weeks', 'now');

    // 1 in 20 chance of being a winner
    $winDate = null;
    $winner = rand(1, 20) == 1;
    if ( $winner ) {
        // Win sometime after being created but before now
        $winDate = $faker->dateTimeBetween($created_at, 'now');
    }
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'location_id' => $location->id,
        'is_winner' => $winDate,
        'created_at' => $created_at,
    ];
});