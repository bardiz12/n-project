<?php

namespace App\Model\Form;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'form';
    protected $fillable = ['name','description','creator_id'];
    private static $formUserRoleData = null;

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

    public function allMaintainer()
    {
        return $this->belongsToMany('App\User', 'form_maintainer', 'form_id', 'users_id')->withPivot('maintainer_roles_id','status');
    }

    public function link(){
        return route('survey.write',[$this->id]);
    }

    public function mapsLink(){
        return route('survey.map',[$this->id]);
    }

    public function content()
    {
        return $this->hasOne('App\Model\Form\Content', 'form_id', 'id');
    }

    public function formUserRole()
    {
        return $this->belongsToMany('App\Model\MaintainerRoles', 'form_maintainer', 'form_id', 'maintainer_roles_Id')->where('status',1)->where('users_id',Auth::user()->id);
    }

    public function getFormUserRoleData(){
        if($this->formUserRoleData == null){
            $this->formUserRoleData = $this->formUserRole;
        }
        return $this->formUserRoleData;
    }

    public function userHasRole($role_slug){
        $this->getFormUserRoleData();
        foreach ($this->formUserRoleData as $key => $value) {
            return ($value->slug === $role_slug);
        }
    }
    
}
