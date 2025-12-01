<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name'            => $this->faker->firstName,
            'last_name'             => $this->faker->lastName,
            'email'                 => $this->faker->unique()->safeEmail(),
            'email_verified_at'     => now(),

            'password'              => Hash::make('123456'),
            'remember_token'        => Str::random(10),

            'api_token'             => Str::random(60),

            'image'                 => null, // or fake avatar
            'status'                => true,
            'is_admin'              => false,
            'is_customer'           => true,

            'active_portal'         => 'customer',

            'two_factor'            => false,
            'two_factor_code'       => null,
            'two_factor_expires_at' => null,
            'two_factor_backup_code'=> null,

            'locale'                => 'en',
            'sms_unit'              => 0,
            'timezone'              => 'UTC',

            'provider'              => null,
            'provider_id'           => null,
        ];
    }

    /**
     * Admin State
     */
    public function admin(): static
    {
        return $this->state([
            'is_admin'   => true,
            'is_customer'=> false,
            'active_portal' => 'admin',
        ]);
    }

    /**
     * Customer State
     */
    public function customer(): static
    {
        return $this->state([
            'is_customer'=> true,
            'active_portal' => 'customer',
        ]);
    }
}
