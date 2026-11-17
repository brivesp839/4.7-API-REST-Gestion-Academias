<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Academy extends Model
{
    //Campos de la tabla academies
    protected $fillable = ['user_id', 'name', 'description', 'address', 'phone', 'email',];

    //Relación 1:N con Usuarios: Una academia pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Una academia tiene muchos cursos
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
