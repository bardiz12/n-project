<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaintainerRoles extends Model
{
    protected $table = 'maintainer_roles';
    protected $fillable = ['slug','name','description'];

    public function badge(){
        $s = $this;
        return '<span class="badge badge-'.(function() use (&$s){
            switch ($s->id) {
                case 1:
                    return 'warning';
                    break;

                case 2:
                    return 'danger';
                    break;
                
                case 3:
                    return 'primary';
                    break;
                default:
                    return '';
                    break;
            }
        })().'">'.$this->name.'</span>';
    }
}
