<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table = 'devices';

    protected $primaryKey = "id";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function clocked()
    {
        return $this->hasMany('App\Clocked');
    }
}
