<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\Academy;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $php = Course::where('name', 'PHP desde cero')->first();
        $ingles = Course::where('name', 'Inglés B1')->first();

        $ana = Student::where('email', 'ana@example.com')->first();
        $luis = Student::where('email', 'luis@example.com')->first();

        $php->students()->attach([$ana->id, $luis->id]);
        $ingles->students()->attach($ana->id);

        $norte = Academy::where('name', 'Academia Norte')->first();

        $norte->courses()->create([
            'name' => 'Preparación de oposiciones',
            'description' => 'Curso intensivo para oposiciones administrativas',
            'start_date' => '2026-09-15',
            'end_date' => '2027-06-30',
            'capacity' => 30,
        ]);
    }
}
