<?php

namespace Tests\Feature\Admin;

use App\Models\User\User;
use App\Repository\User\UserRepository;
use App\Services\User\UserService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCrudTest extends TestCase
{

    use withFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCreate()
    {
        $userAttributes = array(
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'gender' => $this->faker->randomElement(array('Male','Female','Other')),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        );

        $userModel = new User();

        $userRepository = new UserRepository($userModel);

        $userService = new UserService($userRepository);

        $user = $userService->store($userAttributes);

        $this->assertEquals($userAttributes,$user);
    }
}
