<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousels extends Model
{
    use HasFactory;

    protected $table = 'carousels';

    protected $fillable = [
        'name',
        'description',
        'url',
        'banner',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'id';
}
