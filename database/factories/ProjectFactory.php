<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $title = $faker->catchPhrase;
    return [
        'title' => $title,
        'slug' => \Str::slug($title),
        'description' => $faker->text(300),
    ];
});
