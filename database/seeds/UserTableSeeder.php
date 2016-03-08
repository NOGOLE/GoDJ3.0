<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::Create([
          'name' => 'DJ Mastashake',
          'email' => 'jyrone.parker@gmail.com',
          'password' => bcrypt('n1nt3nd0');
          'api_token'=> str_random(60)
          ]);

    }
}
