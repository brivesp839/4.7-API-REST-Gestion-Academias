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
        //Nuevos registros para mi base de datos
        Student::create([
            'name' => 'Ana',
            'surname' => 'López',
            'email' => 'ana@example.com',
            'phone' => '600111222',
            'date_of_birth' => '2000-05-10',
        ]);

        Student::create([
            'name' => 'Luis',
            'surname' => 'García',
            'email' => 'luis@example.com',
            'phone' => '600333444',
            'date_of_birth' => '1998-11-23',
        ]);
    }
}
