<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    protected $table = 'whitelist';

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
}
