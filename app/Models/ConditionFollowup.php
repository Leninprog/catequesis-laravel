<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionFollowup extends Model
{
    use HasFactory;

    protected $table = 'condition_followups';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'condition_id',
        'nivel_anterior',
        'nivel_nuevo',
        'observaciones',
        'fecha',
        'created_by'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function condition()
    {
        return $this->belongsTo(PersonCondition::class, 'condition_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
