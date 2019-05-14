<?php

namespace App\Model\Form\Dashboard;

use Illuminate\Database\Eloquent\Model;

class DashboardItem extends Model
{
    protected $table = 'dashboard_item';
    protected $fillable = ['dashboard_id','column_id','dashboard_elements_id'];

    public function dashboard()
    {
        return $this->belongsTo('App\Form\Dashboard\Dashboard', 'id', 'dashboard_id');
    }

    public function element()
    {
        return $this->hasOne('App\Form\Dashboard\Element', 'id', 'dashboard_elements_id');
    }

    public function column(){
        return $this->hasOne('App\Form\Column', 'id', 'columnd_id');
    }


}
