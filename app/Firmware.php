<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmware extends Model
{
    protected $table = 'firmware';

    protected $primaryKey = "id";

    protected $fillable = ['app_name', 'app_version', 'path', 'description'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;
}
