<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table = 'device';

    protected $primaryKey = "id";

    protected $fillable = ['mac_address', 'version'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id', 'id');
    }

    public function clocked()
    {
        return $this->hasMany('App\Clocked');
    }
}
