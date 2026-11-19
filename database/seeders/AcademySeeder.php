<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Introduzco un usuario para poder trabajar con academia
        $user = User::first();

        //Nuevos registros para mi base de datos
        $user->academies()->create([
            'name' => 'Academia Sur',
            'description' => 'Cursos de informática e idiomas',
            'address' => 'Calle Mayor 1, Almería',
            'phone' => '950000000',
            'email' => 'info@academiasur.com',
        ]);
    }
}
