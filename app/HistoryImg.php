<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryImg extends Model
{
    use SoftDeletes;

    protected $table = 'history_img';

    protected $fillable = [
        'img', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
