<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'post_id' =>App\Post::inRandomOrder()->first()->id,
        'tag_id' =>App\Tag::inRandomOrder()->first()->id,
    ];
});
