<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    $user = factory(App\User::Class)->create();
    return [
        'user_id' => $user->id,
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'start_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'location' => $faker->streetAddress,
        'description' => $faker->sentence,
    ];
});
