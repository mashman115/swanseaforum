<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      $users = User::all();
      for ($i = 1; $i < count($users); $i++){
        $prof = new Profile();
        $prof->user_id = $i;
        $prof->description = $faker->sentence(10);
        $prof->Save();
      };
    }
}
