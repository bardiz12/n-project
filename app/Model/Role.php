<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name','slug'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'roles_id', 'users_id');
    }
}
