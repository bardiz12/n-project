<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Column extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','pertanyaan','type'];
    protected $table = 'form_column';
    private $pilgan_types = ['checkbox','radio','select'];
    private $allowed_column_types = ['checkbox','radio','select','text','textarea'];

    public function pilgan()
    {
        return $this->hasMany('App\Model\Form\ColumnPilgan', 'form_column_id', 'id');
    }

    public function isPilganable(){
        return in_array($this->type,$this->pilgan_types);
    }
    


    
}
