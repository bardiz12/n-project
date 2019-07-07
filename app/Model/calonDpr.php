<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Partai;
class calonDpr extends Model
{
    //
    protected $table = 'calon_dprs';
    protected $fillable = ['nama_calon_dpr','foto','partai_id'];
    public function users()
    {
        return $this->belongsToMany('App\User', 'calon_dpr_user', 'calon_dprs_id', 'users_id');
    }
    public function partai()
    {
        # code...
        return $this->belongsTo(Partai::class);
    }
}
