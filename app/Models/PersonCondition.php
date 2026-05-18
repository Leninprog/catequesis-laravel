<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCondition extends Model
{
    use HasFactory;

    protected $table = 'person_conditions';

    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'subcategory_id',
        'evaluator_id',
        'nivel',
        'prioridad',
        'estado',
        'observaciones',
        'fecha_inicio',
        'fecha_actualizacion'
    ];

    // RELACIONES

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class);
    }

    public function followups()
    {
        return $this->hasMany(ConditionFollowup::class, 'condition_id');
    }
}
