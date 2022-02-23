<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserEmailAlias>
 */
class UserEmailAliasFactory extends Factory
{

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email(),
        ];
    }
}
