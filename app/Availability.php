<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'availabilities';

    protected $primaryKey = "id";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'start_monday',
        'end_monday',
        'start_tuesday',
        'end_tuesday',
        'start_wednesday',
        'end_wednesday',
        'start_thursday',
        'end_thursday',
        'start_friday',
        'end_friday',
        'start_saterday',
        'end_saterday',
        'start_sunday',
        'end_sunday',
        'user_id',
        'week_nr',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
