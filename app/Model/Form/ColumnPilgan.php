<?php

namespace App\Model\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ColumnPilgan extends Model
{
    use SoftDeletes;
    protected $fillable = ['text'];
    protected $table = 'form_column_pilgan';

    public function column()
    {
        return $this->hasOne('App\Model\Form\Column', 'foreign_key', 'local_key');
    }
}
