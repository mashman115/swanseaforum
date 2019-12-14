<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        $admin = new User();
        $admin->name = "admin";
        $admin->username = "admin";
        $admin->email = "admin@admin.com";
        $admin->isAdmin = true;
        $admin->password = Hash::make('admin123');
        $admin->save();

    }
}
