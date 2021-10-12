<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestingEquipment extends Model
{
    use SoftDeletes;

    protected $table = 'testing_equipment';

    protected $fillable = [
        'img', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
