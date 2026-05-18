<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventEvaluator extends Model
{
    use HasFactory;

    protected $table = 'event_evaluators';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'evaluator_id',
        'rol',
        'estado'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'evaluator_id');
    }
}
