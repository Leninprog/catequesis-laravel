<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventTarget;
use App\Models\EventEvaluator;
use App\Models\Enrollment;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'modalidad',
        'cupo_maximo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'created_by'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function targets()
    {
        return $this->hasMany(EventTarget::class, 'event_id');
    }

    public function evaluators()
    {
        return $this->hasMany(EventEvaluator::class, 'event_id');
    }

    public function eventEvaluators()
    {
        return $this->hasMany(EventEvaluator::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'event_id');
    }
}
