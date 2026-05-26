<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    use HasFactory;

    protected $table = 'evaluators';

    protected $fillable = [
        'nombres',
        'apellidos',
        'especialidad',
        'telefono',
        'email',
        'estado',
        'user_id'
    ];

    // RELACIONES

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conditions()
    {
        return $this->hasMany(PersonCondition::class);
    }

    public function eventEvaluators()
    {
        return $this->hasMany(EventEvaluator::class);
    }
}
