<?php


namespace App\Filters;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MovimentoFilters extends QueryFilters
{
    /**
     * Filter by id;
     *
     * @param string $id
     * @return Builder
     */
    public function id($id = ''){
        return $this->builder->where('id', '=', $id);
    }

    /**
     * Filter by aeronave;
     *
     * @param string $aeronave
     * @return Builder
     */
    public function aeronave($aeronave = ''){
        return $this->builder->where('aeronave', '=', $aeronave);
    }

    /**
     * Filter by data_inf;
     *
     * @param string $data_inf
     * @return Builder
     */
    public function data_inf($data_inf= ''){
        return $this->builder->where('data', '=', $data_inf);
    }

    /**
     * Filter by data_sup;
     *
     * @param string $data_sup
     * @return Builder
     */
    public function data_sup($data_sup= ''){
        return $this->builder->where('data', '=', $data_sup);
    }

    /**
     * Filter by naturezaPesquisa;
     *
     * @param string $natureza
     * @return Builder
     */
    public function naturezaPesquisa($natureza= ''){
        return $this->builder->where('natureza', '=', $natureza);
    }

    /**
     * Filter by confirmadoPesquisa;
     *
     * @param string $confirmado
     * @return Builder
     */
    public function confirmadoPesquisa($confirmado= ''){
        return $this->builder->where('confirmado', '=', $confirmado);
    }

    /**
     * Filter by piloto;
     *
     * @param string $piloto
     * @return Builder
     */
    public function piloto($piloto= ''){
        return $this->builder->join('users', 'users.id', '=', 'movimentos.piloto_id')
            ->where('nome_informal', '=', ''.$piloto.'');
    }

    /**
     * Filter by instrutor;
     *
     * @param string $instrutor
     * @return Builder
     */
    public function instrutor($instrutor= ''){
        return $this->builder->join('users', 'users.id', '=', 'movimentos.instrutor_id')
            ->where('nome_informal', 'like', '%'.$instrutor.'%');
    }

    /**
     * Filter by meusMovimentosPesquisa;
     *
     * @param string $meusMovimento
     * @return Builder
     */
    public function meusMovimentosPesquisa($meusMovimento = ''){
        if ($meusMovimento=="on"){
            return $this->builder->where('piloto_id', "=", Auth::User()->id)->orWhere('instrutor_id', '=', Auth::User()->id);
        }

    }
}