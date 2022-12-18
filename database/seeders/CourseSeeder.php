<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create(['name' => 'Computer Science']);
        Course::create(['name' => 'Software Engineering']);
        Course::create(['name' => 'Computer Systems & Networking']);
        Course::create(['name' => 'Graphics & Multimedia Technology']);
    }
}
