<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' =>$faker->sentence(4),
        'content' =>$faker->paragraph(4),
        'user_id' =>App\User::inRandomOrder()->first()->id,
        'photo_name' => $faker->randomElement(["dylanthomascentre.jpeg",
        "osyermouthcastle.jpeg","swanseacastle.jpeg","towncentre.jpg"])
    ];
});
