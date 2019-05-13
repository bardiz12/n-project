<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;

class FormMaintainer extends Model
{
    protected $table = 'form_maintainer';
    protected $fillable = ['form_id','users_id','maintainer_roles_id','status','added_by'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'form_maintainer', 'form_id', 'users_id');
    }

    public static function formUserCanAdmin($form_id){
        return self::where('form_id',$form_id)->where('status',1)->whereIn('maintainer_roles_id',[1,2]);
    }
}
