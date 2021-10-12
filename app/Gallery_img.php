<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery_img extends Model
{
	use SoftDeletes;

    protected $table = 'gallery_imgs';

    protected $fillable = [
        'gallery_id', 'img', 'img_sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function imgs()
    {
       return $this->belongsTo('App\Gallery','gallery_id','id');
    }
}
