<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tag1 = new Tag();
      $tag1->tag = "Computing";
      $tag1->save();

      $tag2 = new Tag();
      $tag2->tag = "Computers";
      $tag2->save();

      $tag3 = new Tag();
      $tag3->tag = "Coursework";
      $tag3->save();

      $tag4 = new Tag();
      $tag4->tag = "Technology";
      $tag4->save();

      $tag5 = new Tag();
      $tag5->tag = "Software";
      $tag5->save();

      $tag6 = new Tag();
      $tag6->tag = "Hardware";
      $tag6->save();

      $tag7 = new Tag();
      $tag7->tag = "Help";
      $tag7->save();

      $tag8 = new Tag();
      $tag8->tag = "Request";
      $tag8->save();
    }
}
