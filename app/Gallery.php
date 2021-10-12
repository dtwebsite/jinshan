<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
	use SoftDeletes;

	protected $table = 'gallery';

    protected $fillable = [
        'gallery_id', 'date', 'title', 'content', 'lang', 'status', 'sort', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function detail_img()
    {
        return $this->hasMany('App\Gallery_img','gallery_id','id');
    }
}
