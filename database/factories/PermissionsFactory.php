<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Junges\ACL\Http\Models\Permission;

$factory->state(Permission::class, 'add_user',function (Faker $faker) {
    return [
        'name' => 'Add User',
        'slug' => 'add_user',
        'description' => 'ability to add a new user'
    ];
});
$factory->state(Permission::class, 'edit_user',function (Faker $faker) {
    return [
        'name' => 'Edit User',
        'slug' => 'edit_user',
        'description' => 'ability to edit users'
    ];
});
