<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    // Campos tabla students
    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'date_of_birth',
    ];

    // Un alumno está en muchos cursos (N:N)
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('enrolled_at') //Permite leer el campo extra de la tabla pivote
            ->withTimestamps(); //Rellena created_at y updated_at de la tabla pivote
    }
}
