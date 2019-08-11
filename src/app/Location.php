<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $primaryKey = "id";

    protected $fillable = [
        'business_id',
        'address',
        'address_nr',
        'postal_code',
        'place',
        'country',
    ];

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
        return $this->hasMany('App\Whitelist');
    }

    public function devices()
    {
        return $this->hasMany('App\Devices', 'location_id');
    }

    public function getFulAddressAttribute()
    {
        return $this->address.' '.$this->address_nr;
    }
}
