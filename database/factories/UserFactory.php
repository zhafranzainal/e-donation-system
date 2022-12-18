<?php

namespace Database\Factories;

use App\Models\User;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $ic_no = $this->faker->regexify('[0]{1}[0-4]{1}[0]{1}[1-9]{1}[0-2]{1}[0-9]{1}[0]{1}[1-9]{1}[0-9]{4}');

        $ic_birthday = DateTime::createFromFormat('ymd', substr($ic_no, 0, 6));
        $dateCurrent  = new DateTime();

        if ($ic_birthday > $dateCurrent) {
            $ic_birthday->modify('-100 years');
        }

        $age = $dateCurrent->diff($ic_birthday)->y;

        $ic_gender = (int) substr($ic_no, 11);
        $gender = ($ic_gender % 2 == 0) ? 'female' : 'male';

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique->email,
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'phone_no' => $this->faker->mobileNumber(true, false),
            'ic_no' => $ic_no,
            'age' => $age,
            'gender' => $gender,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
