<?php

namespace App\Model\Form\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboard';
    protected $fillable = ['form_id','users_id','is_active','title','description'];

    public function item()
    {
        return $this->hasMany('App\Model\Form\Dashboard\DashboardItem', 'dashboard_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'users_id');
    }

    public function form()
    {
        return $this->belongsTo('App\Form\Form', 'id', 'form_id');
    }
}
