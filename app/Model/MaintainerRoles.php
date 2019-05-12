<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaintainerRoles extends Model
{
    protected $table = 'maintainer_roles';
    protected $fillable = ['slug','name','description'];
}
