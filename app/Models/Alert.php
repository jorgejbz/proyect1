<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $collection = 'alerts';

    protected $fillable = [

        'state',       
        'timestamp',
    ];

    public $timestamps = false;
}
