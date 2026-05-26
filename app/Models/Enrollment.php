<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments';

    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'event_id',
        'fecha_inscripcion',
        'estado',
        'observaciones',
        'created_by'
    ];

    /*
    |----------------------------------------------------------------------
    | RELACIONES
    |----------------------------------------------------------------------
    */

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
