<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    
    protected $fillable = [
        'role_name'
    ];

    protected $primaryKey = "id";

    function users(){
		return $this->hasMany('App\User');
	}
}
