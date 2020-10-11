<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Project;
use App\ProjectTag;
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

/**
 * Increment Generator for Sorting Field
 * @return Generator
 */
function autoIncrement() {
    for ($i=0;$i<1000;$i++) {
        yield $i;
    }
}

$autoIncrement = autoIncrement();

$factory->define(ProjectTag::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(1,true),
    ];
});
$factory->define(Project::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    return [
        'title' => $faker->sentence(3,true),
        'subtitle' => $faker->sentence(6,true),
        'overview' => $faker->sentence(6,true),
        'description' => $faker->sentence(6,true),
        'image' => 'https://source.unsplash.com/random/800x600',
        'device_image' => 'https://source.unsplash.com/random/800x600',
        'slug' => $faker->word(),
        'link' => $faker->url(),
        'sorting' => $autoIncrement->current()
    ];
});

$factory->afterCreating(Project::class, function ($row, $faker) {
    $row->tags()->attach(rand(1,3));
});

