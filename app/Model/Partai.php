<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\calonDpr;
class Partai extends Model
{
    //
    protected $table = 'partais';
    protected $fillable = ['nama_partai','logo'];
    public function calon_dpr()
    {
        # code...
        return $this->hasMany(calonDpr::class);
    }
}
