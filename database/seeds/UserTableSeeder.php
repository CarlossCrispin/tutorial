<?php

use Illuminate\Database\Seeder;
use \App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*  User::create(["name" => "Carlos", "email" => "carlos12@gmail.com", "password" => "qwerty"]);
        User::create(["name" => "sss", "email" => "carlosqsffcomposer dump-autoload
        @gmail.com", "password" => "qwerty"]); */

        factory(User::class)->times(40)->create();

    }
}
