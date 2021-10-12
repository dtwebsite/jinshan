<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionEquipment extends Model
{
    use SoftDeletes;

    protected $table = 'production_equipment';

    protected $fillable = [
        'img', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
