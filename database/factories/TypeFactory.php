<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Loan\Type\LoanType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'interest_type' => 'Fixed Monthly Amount',
        'interest_rate' => $faker->numberBetween(1,100),
    ];
});
