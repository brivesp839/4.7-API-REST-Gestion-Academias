<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        //Llamo a los 5 seeders que he creado
        $this->call([
            UserSeeder::class,
            AcademySeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
