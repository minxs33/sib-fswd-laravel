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
        'discount',
        'total_price',
        'stock',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = "id";

    function categories(){
		return $this->belongsTo('App\Models\Categories');
	}

    function users(){
        return $this->belongsTo("App\Models\Users");
    }

    function product_images(){
        return $this->hasMany("App\Models\Product_images");
    }

}
