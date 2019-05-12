<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'form';
    protected $fillable = ['name','description','creator_id'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'creator_id');
    }
    
    public function column()
    {
        return $this->hasMany('App\Model\Form\Column', 'form_id', 'id');
    }
}
