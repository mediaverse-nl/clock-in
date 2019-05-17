<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    protected $primaryKey = "id";

    protected $fillable = [
        'status',
        'location_id',
        'business_id',
        'started_at',
        'stopped_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

//    public function business()
//    {
//        return $this->belongsTo('App\Business', 'business_id', 'id');
//    }
//
//    public function whitelist()
//    {
//        return $this->hasMany('App\Whitelist');
//    }
}
