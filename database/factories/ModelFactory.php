<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Project;
use Faker\Generator as Faker;

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

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3,true),
        'description' => $faker->sentence(6,true),
        'image' => 'https://source.unsplash.com/random/800x600'
    ];
});
