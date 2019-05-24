<?php


namespace App\Filters;


use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MovimentoFilters extends QueryFilters
{
    /**
     * Filter by idMovimentoPesquisa;
     *
     * @param string $id
     * @return Builder
     */
    public function idMovimentoPesquisa($id = ''){
        return $this->builder->where('id', '=', $id);
    }

    /**
     * Filter by aeronavePesquisa;
     *
     * @param string $aeronave
     * @return Builder
     */
    public function aeronavePesquisa($aeronave = ''){
        return $this->builder->where('aeronave', '=', $aeronave);
    }

    /**
     * Filter by dataInfPesquisa;
     *
     * @param string $dataInf
     * @return Builder
     */
    public function dataInfPesquisa($dataInf= ''){
        return $this->builder->where('hora_descolagem', '=', $dataInf);
    }

    /**
     * Filter by dataSupPesquisa;
     *
     * @param string $dataSup
     * @return Builder
     */
    public function dataSupPesquisa($dataSup= ''){
        return $this->builder->where('hora_', '=', $dataSup);
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
     * Filter by nomePilotoPesquisa;
     *
     * @param string $nomePiloto
     * @return Builder
     */
    public function nomePilotoPesquisa($nomePiloto= ''){
        return $this->builder->join('users', 'users.id', '=', 'movimentos.piloto_id')
            ->where('nome_informal', 'like', '%'.$nomePiloto.'%');
    }

    /**
     * Filter by nomeInstrutorPesquisa;
     *
     * @param string $nomeInstrutor
     * @return Builder
     */
    public function nomeInstrutorPesquisa($nomeInstrutor= ''){
        return $this->builder->join('users', 'users.id', '=', 'movimentos.instrutor_id')
            ->where('nome_informal', 'like', '%'.$nomeInstrutor.'%');
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