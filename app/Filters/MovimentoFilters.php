<?php


namespace App\Filters;


use App\User;
use App\Movimento;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $data_sup = Request()->input('data_sup');

        if($data_sup=="") {
            return $this->builder->where('data', '<=', $data_inf);
        }
        else if ($data_inf==$data_sup){
            return $this->builder->where('data', '=', $data_inf);
        }
        else if ($data_sup!=$data_inf){
            return $this->builder->whereBetween('data', array($data_inf, $data_sup));
        }
    }

    /**
     * Filter by data_sup;
     *
     * @param string $data_sup
     * @return Builder
     */
    public function data_sup($data_sup= ''){
        $data_inf = Request()->input('data_inf');

        if($data_inf==""){
            return $this->builder->where('data', '>=', $data_sup);
        }

    }

    /**
     * Filter by natureza;
     *
     * @param string $natureza
     * @return Builder
     */
    public function natureza($natureza= ''){
        if (Request()->input('piloto')!=null && Request()->input('instrutor')!=null) {
            $pilotos_ids = User::where('nome_informal', 'like', '%'.Request()->input('piloto').'%')->get('id');

            $instrutores_ids = User::where('name', 'like', '%'.Request()->input('instrutor').'%')->get('id');


            return $this->builder->Where('natureza', '=', $natureza)->whereIn('piloto_id', $pilotos_ids)
                ->whereIn('instrutor_id', $instrutores_ids);
        }

        if (Request()->input('piloto')!=null) {
            $pilotos_ids = User::where('nome_informal', 'like', '%'.Request()->input('piloto').'%')->get('id');

            return $this->builder->Where('natureza', '=', $natureza)->whereIn('piloto_id', $pilotos_ids);
        }

        return $this->builder->where('natureza', '=', $natureza);


    }

    /**
     * Filter by confirmado;
     *
     * @param string $confirmado
     * @return Builder
     */
    public function confirmado($confirmado= ''){
        return $this->builder->where('confirmado', '=', $confirmado);
    }

    /**
     * Filter by piloto;
     *
     * @param string $piloto
     * @return Builder
     */
    public function piloto($piloto= ''){
        $nomes = explode(" ", $piloto);

switch (count($nomes)) {
            case 1:
                $pilotos_ids = User::where('name', 'like', '%'.$piloto.'%')->get('id');
            break;
            case 2:
                $pilotos_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%')->get('id');
            break;
            case 3:
                $pilotos_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%'.$nomes[2].'%')->get('id');
            break;
            case 4:
                $pilotos_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%'.$nomes[2].'%'.$nomes[3].'%')->get('id');
            break;
        }
    }

    /**
     * Filter by instrutor;
     *
     * @param string $instrutor
     * @return Builder
     */
    public function instrutor($instrutor= ''){
        $nomes = explode(" ", $instrutor);

        switch (count($nomes)) {
            case 1:
                $instrutores_ids = User::where('name', 'like', '%'.$instrutor.'%')->get('id');
            break;
            case 2:
                $instrutores_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%')->get('id');
            break;
            case 3:
                $instrutores_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%'.$nomes[2].'%')->get('id');
            break;
            case 4:
                $instrutores_ids = User::where('name', 'like', '%'.$nomes[0].'%'.$nomes[1].'%'.$nomes[2].'%'.$nomes[3].'%')->get('id');
            break;
        }
    }

    /**
     * Filter by meusMovimentosPesquisa;
     *
     * @param string $meusMovimento
     * @return Builder
     */
    public function meusMovimentos($meusMovimentos = ''){
        if ($meusMovimentos=="on"){
            return $this->builder->where('piloto_id', "=", Auth::User()->id)->orWhere('instrutor_id', '=', Auth::User()->id);

    }}



    public function nrAterragens($nrAterragens = ''){
        return $this->builder->where('num_aterragens','>=',$nrAterragens);
    }


}