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
        'name', 'email', 'password','nome_informal','data_nascimento','nif','telefone','endereco','img'
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



    /*
  * Writes type of socio to string
  */

    public function tSocioToString(){
        switch ($this->tipo_socio) {
            case 'P':
                return 'Piloto';
            case 'NP':
                return 'Não-Piloto';
            case 'A':
                return 'Aeromodelista';
        }

        return 'Unknown';
    }

    public function direcaoToString(){
        switch($this->direcao){
            case 1:
                return 'Sim';
            case 0:
                return 'Não';
        }
        return 'Unknown';
    }

    public function nrLicencaToString(){
        if($this->num_licenca){
            return $this->num_licenca;
        }
        return '-';
    }

    public function movimentoPiloto(){
        return $this->hasMany('App\Movimento', 'piloto_id', 'id');
    }

    protected function movimento()
    {
        return $this->hasMany('App\Movimento', 'instrutor_id', 'id');
    }
}
