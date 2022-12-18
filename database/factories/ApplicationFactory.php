<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::inRandomOrder()->pluck('id')->first(),
            'amount' => $this->faker->randomNumber(2),
            'reason' => \Arr::random([
                'tuition',
                'hostel',
                'convocation',
                'course',
                'muet',
            ]),
            'status' => 'pending',
            'approved_at' => $this->faker->dateTime,
        ];
    }
}
