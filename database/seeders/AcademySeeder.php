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
        $academies = [
            [
                'name' => 'Academia Sur',
                'description' => 'Cursos de informática e idiomas',
                'address' => 'Calle Mayor 1, Almería',
                'phone' => '950000000',
                'email' => 'info@academiasur.com',
            ],
            [
                'name' => 'Academia Norte',
                'description' => 'Formación profesional y oposiciones',
                'address' => 'Avenida del Mediterráneo 25, Almería',
                'phone' => '950111111',
                'email' => 'info@academianorte.com',
            ],
            [
                'name' => 'Centro de Idiomas Levante',
                'description' => 'Inglés, francés y alemán para todos los niveles',
                'address' => 'Calle Real 10, Roquetas de Mar',
                'phone' => '950222222',
                'email' => 'contacto@idiomaslevante.com',
            ],
            [
                'name' => 'Escuela Tecnológica Costa',
                'description' => 'Programación, diseño web y ofimática',
                'address' => 'Paseo Marítimo 5, Aguadulce',
                'phone' => '950333333',
                'email' => 'hola@escuelacosta.com',
            ],
            [
                'name' => 'Academia Música y Arte',
                'description' => 'Clases de guitarra, piano, dibujo y pintura',
                'address' => 'Plaza Vieja 3, Almería',
                'phone' => '950444444',
                'email' => 'info@musicayarte.com',
            ],
        ];

        foreach ($academies as $academy) {
            $user->academies()->create($academy);
        }
    }
}
