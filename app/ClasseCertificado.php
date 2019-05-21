<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasseCertificado extends Model
{
    protected $table = 'classes_certificados';
    protected $primaryKey = 'code';

    public function pilotos(){
        return $this->hasMany('App\User');
    }
}
