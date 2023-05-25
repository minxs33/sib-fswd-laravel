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
        'url',
        'banner',
        'is_active',
    ];

    protected $primaryKey = 'id';
}
