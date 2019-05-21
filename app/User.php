<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','num_socio','sexo','ativo','quota_paga', 'email', 'password','nome_informal','data_nascimento','nif','telefone','endereco','img','certificado_confirmado',
        'tipo_socio','quota_paga','ativo','password_inicial','direcao','num_licenca','tipo_licenca','instrutor','aluno',
        'validade_licenca','licenca_confirmada','num_certificado','classe_certificado','validade_certificado','licenca'
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
        return $this->num_licenca != null ? $this->num_licenca : '-';
    }

    public function ativoToString(){
        return $this->ativo == 1 ? "Sim" : "Não";
    }

    public function quotasToString(){
        return $this->quota_paga == 1 ? "Sim" : "Não";
    }

    public function aeronaves(){
        return $this->belongsToMany('App\Aeronave','aeronaves_pilotos','piloto_id','matricula');
    }

   public function tipoLicenca(){
        return $this->belongsTo('App\TipoLicenca','tipo_licenca');
    }

    public function classeCertificado(){
        return $this->belongsTo('App\ClasseCertificado','classe_certificado');
    }


    public function movimentos(){
        return $this->hasMany('App\Movimento');
    }

}
