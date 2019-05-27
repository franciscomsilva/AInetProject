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

    public function toString(){
        switch ($this->nome){
            case 'Class 1 medical certificate':
                return 'Class 1';

            case 'Class 2 medical certificate':
                return 'Class 2';

            case 'Light Aircraft Pilot Licence Medical':
                return 'LAPL';
        }
        return 'Unknown';
    }

}
