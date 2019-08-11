<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    protected $table = 'functions';

    protected $primaryKey = "id";

    protected $fillable = ['business_id', 'value'];

    public $timestamps = false;

    public $incrementing = true;

    public function business()
    {
        return $this->belongsTo('App\Business', 'business_id', 'id');
    }

    public function userFunction()
    {
        return $this->hasMany('App\UserFunctions', 'function_id', 'id');
    }

    public function shortNames(){
        $words = explode(' ', $this->value);
        $acronym = "";

        if (count($words) > 1){
            foreach ($words as $w) {
                $acronym .= $w[0];
            }
        }else{
            $acronym = substr($this->value, 0, 3);
        }

        return strtoupper($acronym);
    }
}
