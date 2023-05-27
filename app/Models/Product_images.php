<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    use HasFactory;

    protected $table = "product_images";

    protected $fillable = [
        "products_id",
        "image_url",
        "is_active"
    ];

    protected $primaryKey = "id";

    function products(){
        return $this->belongsTo('App\Products');
    }
}
