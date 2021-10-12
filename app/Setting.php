<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $fillable = [
        'name', 'key', 'value', 'created_at', 'updated_at',
    ];

    public $timestamps = true;
}
