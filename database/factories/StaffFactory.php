<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'rank' => \Arr::random([
                'lecturer',
                'senior lecturer',
                'associate professor',
                'professor',
            ]),
        ];
    }
}
