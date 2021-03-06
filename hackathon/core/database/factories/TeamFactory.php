<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(125),
        'created_at' => Carbon::now(),
    ];
});
