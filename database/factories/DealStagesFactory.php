<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DealStages;
use App\Model;
use Faker\Generator as Faker;

$factory->define(DealStages::class, function (Faker $faker) {
    return [
        //
    ];
});
$factory->state(DealStages::class, 'untouched',function (Faker $faker) {
    return [
        'title' => 'Untouched',
        'headerBg' => 'yellow'
    ];
});
$factory->state(DealStages::class, 'first_visit',function (Faker $faker) {
    return [
        'title' => 'First Visit',
        'headerBg' => 'blue'
    ];
});
$factory->state(DealStages::class, 'proposal',function (Faker $faker) {
    return [
        'title' => 'Proposal Prepared',
        'headerBg' => 'indigo'
    ];
});
$factory->state(DealStages::class, 'quote',function (Faker $faker) {
    return [
        'title' => 'Quote Sent',
        'headerBg' => 'red'
    ];
});
$factory->state(DealStages::class, 'confirm',function (Faker $faker) {
    return [
        'title' => 'Confirm Terms',
        'headerBg' => 'green'
    ];
});