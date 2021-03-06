@extends('layouts.app')

@section('title','Sócios')

@section('content')
<!-- secção dos breadcrumbs -->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Flight-Club</a></li>
        <li class="breadcrumb-item active">Sócios</li>
    </ol>
</nav>




<div class="row"> <!-- secção dos filtros e ações c-->
    <div class="col">
        <div class="card" style="margin-bottom: 50px;">
            <div class="card-header">
                <h3 class="card-title">Filtrar</h3>
            </div>
            <div class="card-body">
                <form action="{{URL::Current()}}">
                    <div class="row">
                        <div class="col">
                            <label for="nrSocio">Nº Sócio:</label>
                            <input type="number" class="form-control" name="nrSocio" placeholder="Nº de Sócio"/>
                        </div>
                        <div class="col">
                            <label for="nome">Nome :</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome Informal"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control" name="email" placeholder="E-Mail"/>
                        </div>
                        <div class="col">
                            <label for="inputTSocio">Tipo de Sócio</label>
                            <select name="tSocio" class="form-control">
                                <option disabled selected value></option>
                                <option  value="P">Piloto</option>
                                <option  value="NP">Não-Piloto</option>
                                <option  value="A">Aeromodelista</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="inputDirecao">Direção</label>
                            <select name="direcao" class="form-control">
                                <option disabled selected value></option>
                                <option  value="1">Sim</option>
                                <option  value="0">Não</option>
                            </select>
                        </div>
                        <div class="col">
                            @can('viewAtivo',App\User::class)
                                <label for="inputAtivo">Sócio Ativo</label>
                                <select name="ativo" class="form-control">
                                    <option disabled selected value></option>
                                    <option  value="1">Sim</option>
                                    <option  value="0">Não</option>
                                </select>
                            @endcan
                        </div>
                        <div class="col">
                            @can('viewQuota',App\User::class)
                                <label for="inputQuota">Quota em Dia</label>
                                <select name="quotaPaga" class="form-control">
                                    <option disabled selected value></option>
                                    <option  value="1">Sim</option>
                                    <option  value="0">Não</option>
                                </select>
                            @endcan
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success" name="search">Pesquisar</button>
                        </div>
                    </div>
                </form>       
            </div>
        </div>
    </div>
    @if(Auth::user()->direcao)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ações</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @can('create', App\User::class)
                            <div class="row">
                                <div class="col">

                                    <a class="btn btn-primary" style="width: 100%" href="{{route('user.create')}}">Adicionar sócio</a>
                                </div>

                            </div>
                        @endcan
                        <br>
                        @can('resetQuotas',App\User::class)
                            <div class="row">
                                <div class="col">
                                    <form action="{{route('user.resetQuotas')}}" method="post" class="form-group">
                                        {{ method_field('PATCH') }}
                                        {{csrf_field()}}
                                        <button type="submit" style="width: 100%" class="btn btn-primary" name="resetQuotas">Reset Quotas</button>
                                    </form>
                                </div>
                            </div>
                        @endcan

                        @can('resetQuotas',App\User::class)
                            <div class="row">
                                <div class="col">
                                    <form action="{{route('user.desativarSQuotas')}}" method="post" class="form-group">
                                        {{ method_field('PATCH') }}
                                        {{csrf_field()}}
                                        <button type="submit" style="width: 100%" class="btn btn-dark" name="desativaUserQuotas">Desativar p/pagar</button>
                                    </form>
                                </div>
                            </div>
                        @endcan
                    </div> 
                </div>
            </div>
        </div>
    @endif
</div>
    @if (count($users))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo de Sócio</th>
                <th>Nº de licença</th>
                <th>Membro da Direção</th>
                <th>
                    @can('viewAtivo',App\User::class)
                        Sócio Ativo
                    @endcan
                </th>
                <th>
                    @can('viewQuota',App\User::class)
                        Quotas em Dia
                    @endcan
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
        @if(Auth::user()->direcao)
            @foreach($users as $user)
                <tr>
                        <td><img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/> </td>
                        <td>{{$user->name}}</td>
                        <td> {{ $user->email }}</td>
                        <td>{{ $user->tSocioToString()}}</td>
                        <td>{{$user->nrLicencaToString()}}</td>
                        <td>{{$user->direcaoToString()}}</td>

                        <td>
                            @can('viewAtivo',App\User::class)
                                {{$user->ativoToString()}}
                            @endcan
                        </td>
                        <td>
                            @can('viewQuota',App\User::class)
                                {{$user->quotasToString()}}
                            @endcan
                        </td>
                        <td>
                            <div class="dropdown-lg">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opções
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                    @can('update', $user)
                                        <a class="dropdown-item" href="{{route('user.edit', $user)}}">Editar</a>
                                    @endcan

                                    @can('view',$user)
                                        <a class="dropdown-item" href="{{route('user.show', $user)}}">Ver</a>
                                    @endcan
                                    
                                    
                                    @can('viewAtivo',$user)
                                        <form action="{{route('user.ativo',$user)}}" method="post" class="form-group">
                                            {{ method_field('PATCH') }}
                                            {{csrf_field()}}
                                                @if($user->ativo)
                                                    <button type="submit" class="dropdown-item" name="ok">Desativar</button>
                                                @else
                                                    <button type="submit" class="dropdown-item" name="ok">Ativar</button>
                                                @endif
                                        </form>
                                    @endcan
                                
                                
                                    @can('viewQuota',$user)
                                        <form action="{{route('user.quota',$user)}}" method="post" class="form-group">
                                            {{ method_field('PATCH') }}
                                            {{csrf_field()}}
                                            <!--div class="form-group"-->
                                                <button type="submit" class="dropdown-item" name="ok">Alterar Quota</button>
                                            <!--/div-->
                                        </form>
                                    @endcan
                                    
                                </div>

                            </div>
                        </td>

                </tr>
            @endforeach
            @else
            @foreach($users as $user)
                <tr>
                    @if($user->ativo)
                    <td><img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/> </td>
                    <td>{{$user->name}}</td>
                    <td> {{ $user->email }}</td>
                    <td>{{ $user->tSocioToString()}}</td>
                    <td>{{$user->nrLicencaToString()}}</td>
                    <td>{{$user->direcaoToString()}}</td>

                    <td>
                        @can('viewAtivo',App\User::class)
                            {{$user->ativoToString()}}
                        @endcan
                    </td>
                    <td>
                        @can('viewQuota',App\User::class)
                            {{$user->quotasToString()}}
                        @endcan
                    </td>
                    <td>
                        @can('viewAtivo',$user)
                            <form action="{{route('user.ativo',$user)}}" method="post" class="form-group">
                                {{ method_field('PATCH') }}
                                {{csrf_field()}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-xs btn-primary" name="ok">Ativar/Desativar</button>
                                </div>
                            </form>
                        @endcan
                        @can('viewQuota',$user)
                            <form action="{{route('user.quota',$user)}}" method="post" class="form-group">
                                {{ method_field('PATCH') }}
                                {{csrf_field()}}
                                <div class="form-group">
                                
                                    @if($user->ativo)
                                        <button type="submit" class="btn btn-xs btn-danger" name="ok">Desativar</button>
                                    @else
                                        <button type="submit" class="btn btn-xs btn-success" name="ok">Ativar</button>
                                    @endif
                                </div>
                            </form>
                        @endcan
                        @can('update', $user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.edit', $user)}}">Editar</a>
                        @endcan
                        @can('view',$user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.show', $user)}}">Ver</a>
                        @endcan
                    </td-->
                    @endif
                </tr>
            @endforeach
            @endif
        </table>

        {{$users->appends($_GET)->links()}}
    @else

        <h2>No users found</h2>

    @endif


@endsection

