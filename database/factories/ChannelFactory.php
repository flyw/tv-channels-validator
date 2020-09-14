<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {

    return [
        'playlist_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'scheme' => $faker->word,
        'domain' => $faker->word,
        'url' => $faker->word,
        'valid' => $faker->word,
        'check_count' => $faker->randomDigitNotNull,
        'valid_count' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
