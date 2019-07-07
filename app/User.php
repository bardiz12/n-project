<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'user_roles', 'users_id', 'roles_id');
    }
    
    public function formAdmin()
    {
        return $this->belongsToMany('App\Model\Form\Form', 'form_maintainer', 'users_id', 'form_id')->where('status',1)->withPivot('maintainer_roles_id', 'status','added_by')->groupBy('form_id');
    }

    public function invitationAdmin()
    {
        return $this->belongsToMany('App\Model\Form\Form', 'form_maintainer', 'users_id', 'form_id')->where('status',0)->withPivot('maintainer_roles_id','status','added_by','id')->groupBy('form_id');
    }
    public function calon_dpr()
    {
        # code...
        return $this->belongsToMany('App\Model\calonDpr','calon_dpr_user','users_id','calon_dprs_id');
    }

}
