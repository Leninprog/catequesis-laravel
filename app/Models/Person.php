<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'telefono',
        'email',
        'direccion',
        'estado',
        'created_by'
    ];

    // RELACIONES

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function conditions()
    {
        return $this->hasMany(PersonCondition::class);
    }
}
