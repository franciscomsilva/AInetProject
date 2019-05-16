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
}
