<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_images extends Model
{
    protected $table = 'products_details';
    protected $fillable = ['image_src','title','p_id','p_handle'];
}
