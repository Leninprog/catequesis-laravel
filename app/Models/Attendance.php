<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    public $timestamps = false;

    protected $fillable = [
        'enrollment_id',
        'fecha_asistencia',
        'estado',
        'observaciones',
        'created_by'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
