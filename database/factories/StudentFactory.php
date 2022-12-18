<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Course;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'staff_id' => Staff::inRandomOrder()->pluck('id')->first(),
            'course_id' => Course::inRandomOrder()->pluck('id')->first(),
            'bank_id' => Bank::inRandomOrder()->pluck('id')->first(),
            'matric_no' => $this->faker->bothify('CB20###'),
            'year' => $this->faker->numberBetween(1, 4),
            'sem' => $this->faker->numberBetween(1, 3),
            'account_no' => $this->faker->bankAccountNumber(),
        ];
    }
}
