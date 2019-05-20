@if (count($pilotos))
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Quota paga</th>
                <th>Nº de licença</th>
                <th>Tipo de licença</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pilotos as $piloto)
                @if($piloto->ativo && $piloto->tipo_socio = "P")
                <tr>
                    <td><img src="{{ $piloto->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $piloto->foto_url)}}"  height="50px" width="50px"  class="img-thumbnail"/> </td>
                    <td>{{ $piloto->name }}</td>
                    <td>{{ $piloto->email }}</td>
                    <td>{{ $piloto->quota_paga }}</td>
                    <td>{{ $piloto->nrLicencaToString() }}</td>
                    <td>{{ $piloto->tipo_licenca }}</td>
                    <td>
                        @can('authorize', $piloto)
                            <a class="btn btn-xs btn-primary" style="color: #ffff;">{{ $textoButao }}</a> <!-- Apagar este e descomentar o outro... -->
                            <!--a class="btn btn-xs btn-primary" style="color: #ffff;" href="{{ route( $adicionarRemover, $aeronave, $piloto ) }}">{{ $textoButao }}</a-->
                        @endcan
                    </td>
                </tr>
                @endif
            @endforeach
        </table>

        {{$pilotos->links()}}

    @else

        <h2>Não foram encontrados pilotos</h2>

    @endif