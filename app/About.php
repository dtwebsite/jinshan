<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = [
        'name', 'key',  'value', 'created_at', 'updated_at',
    ];

    public $timestamps = true;
}
