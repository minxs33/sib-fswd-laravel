<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'description',
        'price',
        'status',
        'stock'
    ];

    protected $primaryKey = "id";

    function categories(){
		return $this->belongsTo('App\Categories');
	}

    function users(){
        return $this->belongsTo("App\Users");
    }

    function product_images(){
        return $this->hasMany("App\Product_images");
    }

}
