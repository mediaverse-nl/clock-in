<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';

    protected $primaryKey = "id";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function package()
    {
        return $this->belongsTo('App\Packages');
    }

    public function settings()
    {
        return $this->belongsTo('App\Settings');
    }

    public function locations()
    {
        return $this->hasMany('App\Location', 'business_id', 'id');
    }
}
