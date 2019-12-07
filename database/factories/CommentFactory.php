<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' =>$faker->sentence(10),
        'post_id' =>App\Post::inRandomOrder()->first()->id,
        'user_id' =>App\User::inRandomOrder()->first()->id,
    ];
});
