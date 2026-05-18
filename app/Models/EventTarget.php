<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTarget extends Model
{
    use HasFactory;

    protected $table = 'event_targets';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'subcategory_id',
        'nivel_min',
        'nivel_max'
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

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
