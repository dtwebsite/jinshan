<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Products_img extends Model
{
	use SoftDeletes;

    protected $table = 'products_imgs';

    protected $fillable = [
        'product_id', 'img', 'img_sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function imgs()
    {
       return $this->belongsTo('App\Products','product_id','id');
    }
}
