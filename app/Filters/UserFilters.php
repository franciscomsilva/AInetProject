<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilters extends QueryFilters
{


    /**
     * Filter by nrSocio;
     *
     * @param string $nr
     * @return Builder
     */
    public function nrSocio($nr = '')
    {
        return $this->builder->where('num_socio', '=',$nr);
    }

    public function nome($name = '')
    {
        return $this->builder->where('nome_informal','like','%'.$name.'%');
    }

    public function email($email = ''){
        return $this->builder->where('email','=',$email);
    }

    public function tSocio($tipo = ''){
        return $this->builder->where('tipo_socio','=',$tipo);
    }

    public function direcao($direcao = ''){
        return $this->builder->where('direcao','=',$direcao);
    }

}
