@extends('layouts.app')

@section('title','Sócios')

@section('content')
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ações</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                    
                        @can('create', App\User::class)

                        <a class="btn btn-primary" href="{{route('user.create')}}">Adicionar sócio</a>

                        @endcan
                    </div>
                    
                    <div class="col">
                        @can('resetQuotas',App\User::class)
                            <form action="{{route('user.resetQuotas')}}" method="post" class="form-group">
                                    {{ method_field('PATCH') }}
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-primary" name="resetQuotas">Reset Quotas</button>
                            </form>
                        @endcan
                    </div>
                    
                    <div class="col">
                        @can('resetQuotas',App\User::class)
                            <form action="{{route('user.desativarSQuotas')}}" method="post" class="form-group">
                                {{ method_field('PATCH') }}
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-dark" name="desativaUserQuotas">Desativar p/pagar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div> 
        </div>
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
                        @can('update', $user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.edit', $user)}}">Editar</a>
                        @endcan

                        @can('view',$user)
                            <a class="btn btn-xs btn-success" href="{{route('user.show', $user)}}">Ver</a>
                        @endcan
                        </td>
                        <td>
                            @can('viewAtivo',$user)
                                <form action="{{route('user.ativo',$user)}}" method="post" class="form-group">
                                    {{ method_field('PATCH') }}
                                    {{csrf_field()}}
                                    <div class="form-group">
                                    
                                        @if($user->ativo)
                                            <button type="submit" class="btn btn-xs btn-danger" name="ok">Desativar</button>
                                        @else
                                            <button type="submit" class="btn btn-xs btn-success" name="ok">Ativar</button>
                                        @endif
                                        <!--button type="submit" class="btn btn-xs btn-danger" name="ok">Ativar/Desativar</button-->
                                    </div>
                                </form>
                            @endcan
                        </td>
                        <td>
                            @can('viewQuota',$user)
                                <form action="{{route('user.quota',$user)}}" method="post" class="form-group">
                                    {{ method_field('PATCH') }}
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-xs btn-info" name="ok">Alterar Quota</button>
                                    </div>
                                </form>
                            @endcan
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
                                    <!--button type="submit" class="btn btn-xs btn-danger" name="ok">Ativar/Desativar</button-->
                                </div>
                            </form>
                        @endcan
                        @can('update', $user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.edit', $user)}}">Editar</a>
                        @endcan
                        @can('view',$user)
                            <a class="btn btn-xs btn-primary" href="{{route('user.show', $user)}}">Ver</a>
                        @endcan
                    </td>
                    @endif
                </tr>
            @endforeach
            @endif
        </table>

        {{$users->links()}}
    @else

        <h2>No users found</h2>

    @endif


@endsection

