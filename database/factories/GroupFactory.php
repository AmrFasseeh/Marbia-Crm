<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Junges\ACL\Http\Models\Group;

$factory->state(Junges\ACL\Http\Models\Group::class, 'admin',function (Faker $faker) {
    return [
        'name' => 'Admin',
        'slug' => 'admin',
        'description' => 'dashboard admin'
    ];
});
$factory->state(Junges\ACL\Http\Models\Group::class, 'user',function (Faker $faker) {
    return [
        'name' => 'User',
        'slug' => 'user',
        'description' => 'dashboard user'
    ];
});
