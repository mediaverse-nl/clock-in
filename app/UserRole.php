<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    protected $primaryKey = "id";

    public $incrementing = true;

    /**
     * Get the user that owns the phone.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
