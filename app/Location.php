<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $primaryKey = "id";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function business()
    {
        return $this->belongsTo('App\Business', 'business_id', 'id');
    }

    public function whitelist()
    {
        return $this->belongsToMany('App\Whitelist');
    }

    public function devices()
    {
        return $this->belongsToMany('App\Devices');
    }
}
