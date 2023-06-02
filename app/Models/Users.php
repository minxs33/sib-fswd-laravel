<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
        'role',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $primaryKey = 'id';
    
    function roles(){
		return $this->belongsTo('App\Models\Roles');
	}

    function products(){
        return $this->hasMany('App\Models\Products');
    }
}
