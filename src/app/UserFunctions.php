<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFunctions extends Model
{
    protected $table = 'user_functions';

    protected $primaryKey = "id";

    protected $fillable = ['user_id', 'function_id'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function functions()
    {
        return $this->belongsTo('App\Functions', 'function_id', 'id');
    }
}
