<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        User::factory()->count(1)->create([
            'email' => 'admin@admin.com',
            'password' => \Hash::make('admin'),
        ]);

        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StudentSeeder::class);

        $this->call(ApplicationSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
