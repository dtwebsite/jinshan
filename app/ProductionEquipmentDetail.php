<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionEquipmentDetail extends Model
{
    use SoftDeletes;

    protected $table = 'production_equipment_detail';

    protected $fillable = [
        'pid', 'name', 'sort', 'lang', 'en_check', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
