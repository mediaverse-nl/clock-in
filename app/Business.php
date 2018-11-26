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

    protected $fillable = ['name', 'coc_nr', 'vat_nr', 'bank_name', 'bank_iban', 'address', 'address_nr', 'postal_code', 'place', 'country'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function package()
    {
        return $this->hasOne('App\Packages');
    }

    public function settings()
    {
        return $this->hasOne('App\Settings');
    }

    public function locations()
    {
        return $this->hasMany('App\Location', 'business_id', 'id');
    }

    public function functions()
    {
        return $this->hasMany('App\Functions', 'business_id', 'id');
    }
}
