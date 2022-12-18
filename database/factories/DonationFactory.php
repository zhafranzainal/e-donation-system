<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'amount' => $this->faker->randomNumber(2),
            'status' => 'pending',
        ];
    }
}
