<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class Posts_TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $tags = App\Tag::all();

      App\Post::all()->each(function ($post) use ($tags) {
        $post->tags()->attach(
          $tags->random(2)->pluck('id')->toArray()
        );
      });
    }
}
