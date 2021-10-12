<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
	use SoftDeletes;

	protected $table = 'products';

    protected $fillable = [
        'product_id', 'name', 'img', 'features', 'application', 'material', 'lang', 'status', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function detail_img()
    {
        return $this->hasMany('App\Products_img','product_id','id');
    }
}
