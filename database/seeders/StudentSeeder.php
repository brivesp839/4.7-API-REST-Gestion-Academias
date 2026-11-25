<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $students = [
            [
                'name' => 'Ana',
                'surname' => 'López',
                'email' => 'ana@example.com',
                'phone' => '600111222',
                'date_of_birth' => '2000-05-10',
            ],
            [
                'name' => 'Luis',
                'surname' => 'García',
                'email' => 'luis@example.com',
                'phone' => '600333444',
                'date_of_birth' => '1998-11-23',
            ],
            [
                'name' => 'Marta',
                'surname' => 'Sánchez',
                'email' => 'marta@example.com',
                'phone' => '600555666',
                'date_of_birth' => '2001-03-15',
            ],
            [
                'name' => 'Pablo',
                'surname' => 'Fernández',
                'email' => 'pablo@example.com',
                'phone' => '600777888',
                'date_of_birth' => '1999-07-02',
            ],
            [
                'name' => 'Lucía',
                'surname' => 'Martínez',
                'email' => 'lucia@example.com',
                'phone' => null,
                'date_of_birth' => '2002-01-28',
            ],
            [
                'name' => 'David',
                'surname' => 'Romero',
                'email' => 'david@example.com',
                'phone' => '600999000',
                'date_of_birth' => '1997-09-14',
            ],
            [
                'name' => 'Elena',
                'surname' => 'Navarro',
                'email' => 'elena@example.com',
                'phone' => '600121212',
                'date_of_birth' => '2003-12-05',
            ],
            [
                'name' => 'Javier',
                'surname' => 'Torres',
                'email' => 'javier@example.com',
                'phone' => null,
                'date_of_birth' => '1996-04-19',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
