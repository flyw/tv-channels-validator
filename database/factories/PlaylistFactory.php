<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Playlist;
use Faker\Generator as Faker;

$factory->define(Playlist::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'keywords' => $faker->text,
        'priority' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
