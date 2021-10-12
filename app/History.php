<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;

    protected $table = 'history';

    protected $fillable = [
        'hid', 'year', 'content', 'lang', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
