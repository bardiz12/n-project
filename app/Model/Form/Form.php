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

    public function maintainer()
    {
        return $this->belongsToMany('App\User', 'form_maintainer', 'form_id', 'users_id')->where('status',1)->whereIn('maintainer_roles_id',[1,2]);
    }

    public function link(){
        return route('survey.write',[$this->id]);
    }

    public function content()
    {
        return $this->hasMany('App\Model\Form\Content', 'form_id', 'id');
    }
    
}
