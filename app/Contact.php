<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'company', 'contact_person', 'phone', 'address', 'product_category', 'product_specification', 'container_material', 'contents', 'message', 'status', 'created_at', 'updated_at',
    ];

    public $timestamps = true;
}
