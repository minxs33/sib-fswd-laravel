<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'email',
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
