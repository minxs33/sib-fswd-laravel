<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = "id";

    function products(){
        return $this->hasMany('App\Products');
    }
}
