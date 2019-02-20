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

    protected $fillable = [];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
