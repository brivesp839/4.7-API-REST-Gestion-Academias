<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    // Campos tabla cursos
    protected $fillable = [
        'academy_id', 'name', 'description', 'start_date', 'end_date', 'capacity',
    ];

    // Un curso pertenece a una academia
    public function academy(): BelongsTo
    {
        return $this->belongsTo(Academy::class); 
    }

    // Un curso tiene muchos alumnos (N:N)
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('enrolled_at')
            ->withTimestamps();
    }
}
