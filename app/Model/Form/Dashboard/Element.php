<?php

namespace App\Model\Form\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'dashboard_elements';
    protected $fillable = ['slug','name','description','is_active','type'];
}
