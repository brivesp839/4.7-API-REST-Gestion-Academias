<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Academy;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Introduzco la academia para trabajar con los cursos
        $academy = Academy::first();

        $academy->courses()->create([
            'name' => 'PHP desde cero',
            'description' => 'Introducción a PHP',
            'start_date' => '2026-09-01',
            'end_date' => '2026-12-15',
            'capacity' => 20,
        ]);

        $academy->courses()->create([
            'name' => 'Inglés B1',
            'description' => 'Preparación del nivel B1',
            'start_date' => '2026-10-01',
            'end_date' => '2027-02-28',
            'capacity' => 15,
        ]);
    }
}
