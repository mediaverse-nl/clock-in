<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = "id";

    public $incrementing = true;

    public function userRoles()
    {
        return $this->hasMany('App\UserRole');
    }
}
