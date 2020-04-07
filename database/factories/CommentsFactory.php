<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comments;
use App\Models\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Comments::class, function (Faker $faker) {
    $count = User::count();
    $count2 = Post::count();

    return [
        "content" => $faker->text($maxNbChars = 50),
        "user_id" => $faker->numberBetween(1,$count),
        "post_id" => $faker->numberBetween(1,$count2),

    ];
});
