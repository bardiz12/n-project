<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'form_content';
    protected $fillable = ['form_id','content','users_id'];
    protected $casts = [
        'content' => 'array',
    ];

    public function form()
    {
        return $this->hasOne('App\Model\Form\Form', 'id', 'form_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'users_id');
    }
}
