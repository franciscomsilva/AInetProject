{{csrf_field()}}
<div class="form-group">
    <label for="photo">Foto</label>

    <!-- MOSTRA FOTO DO USER  -->
    <img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/>


</div>
@if(Auth::user()->direcao)
    <div class="form-group">
        <label for="nrSocio">Nº de Sócio</label>
        <input disabled
                type="number" class="form-control"
                name="num_socio" id="num_socio"
                placeholder="Nº de Sócio" value="{{old('num_socio', $user->num_socio)}}"/>
    </div>

    <div class="form-group">
        <label for="inputSexo">Sexo</label>
        <select disabled name="sexo">
            <option {{$user->sexo == "M" ? 'selected' : ''}} value="M">Masculino</option>
            <option {{$user->sexo == "F" ? 'selected' : ''}}  value="F">Feminino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="inputTSocio">Tipo de Socio</label>
        <select disabled name="tipo_socio">
            <option {{$user->tipo_socio == "P" ? 'selected' : ''}} value="P">Piloto</option>
            <option {{$user->tipo_socio == "NP" ? 'selected' : ''}} value="NP">Não-Piloto</option>
            <option {{$user->tipo_socio == "A" ? 'selected' : ''}} value="A">Aeromodelista</option>
        </select>
    </div>
    <div class="form-group">
        <label for="inputSocioAtivo">Sócio Ativo</label>
        <input
                type="checkbox"
                name="ativo"
                value="1"
                onclick="return false;"
                {{$user->ativo == 1 ?'checked' : ''}}/>
    </div>
    <div class="form-group">
        <label for="inputQuota">Quota em Dia</label>
        <input
                type="checkbox"
                name="quota_paga"
                value="1"
                onclick="return false;"
                {{$user->quota_paga == 1 ?'checked' : ''}}/>
    </div>
    <div class="form-group">
        <label for="inputDirecao">Direção</label>
        <input
                type="checkbox"
                name="direcao"
                value="1"
                onclick="return false;"
                {{$user->direcao == 1 ?'checked' : ''}}/>
    </div>
@endif
<div class="form-group">
    <label for="inputFullname">Nome Completo</label>
    <input disabled
            type="text" class="form-control"
            name="name" id="inputName"
            placeholder="Nome Completo" value="{{$user->name}}" />
</div>
<div class="form-group">
    <label for="inputInformalName">Nome Informal</label>
    <input disabled
            type="text" class="form-control"
            name="nome_informal" id="inputName"
            placeholder="Nome Informal" value="{{$user->nome_informal}}" />
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input disabled
            type="email" class="form-control"
            name="email" id="inputEmail"
            placeholder="Endereço Email" value="{{$user->email}}"/>
</div>
<div class="form-group">
    <label for="birthDate">Data de Nascimento</label>
    <input disabled
            type="date" class="form-control"
            name="data_nascimento" id="birthDate"
            placeholder="Data de Nascimento" value="{{$user->data_nascimento}}"/>
</div>
<div class="form-group">
    <label for="nif">NIF</label>
    <input disabled
            type="number" class="form-control"
            name="nif" id="nif"
            placeholder="NIF" value="{{$user->nif}}"/>
</div>
<div class="form-group">
    <label for="phoneNumber">Número de Telefone</label>
    <input disabled
            type="text" class="form-control"
            name="telefone" id="phoneNumber"
            placeholder="Número de Telefone" value="{{$user->telefone}}"/>
</div>
<div class="form-group">
    <label for="address">Endereço</label>
    <input disabled
            type="text" class="form-control"
            name="endereco" id="address"
            placeholder="Endereço" value="{{$user->endereco}}"/>
</div>
@if($user->tipo_socio == 'P')
    <br>
    <h1> Piloto </h1>
    <h2>Licença de Piloto</h2>
    <div class="form-group">
        <label for="inputNrLicenca">Nº de Licença</label>
        <input disabled
                type="number" class="form-control"
                name="num_licenca" id="nrLicenca"
                placeholder="Número de Licença" value="{{$user->num_licenca}}"/>
    </div>
    <div class="form-group">
        <label for="inputTLicenca">Tipo de Licença</label>
        <select disabled name="tipo_licenca">
            <option {{$user->tipoLicenca->nome == "Aluno - Private Pilot License Airplane" ? 'selected' : ''}} value="ALUNO-PPL(A)">ALUNO-PPL(A)</option>
            <option {{$user->tipoLicenca->nome == "Aluno - Piloto de Ultraleve"? 'selected' : ''}} value="ALUNO-PU">ALUNO-PU</option>
            <option {{$user->tipoLicenca->nome == "Airline Transport Pilot License" ? 'selected' : ''}} value="ATPL">ATPL</option>
            <option {{$user->tipoLicenca->nome == "Comercial Pilot License Airplane" ? 'selected' : ''}} value="CPL(A)">CPL(A)</option>
            <option {{$user->tipoLicenca->nome == "Private Pilot License Airplane" ? 'selected' : ''}} value="PPL(A)">PPL(A)</option>
            <option {{$user->tipoLicenca->nome == "Piloto de Ultraleve" ? 'selected' : ''}}  value="PU">PU</option>
        </select>
    </div>
    <div class="form-group">
        <label for="expiryDateLicenca">Validade da Licença</label>
        <input disabled
                type="date" class="form-control"
                name="validade_licenca" id="expiryDateLicenca"
                placeholder="Validade da Licença" value="{{$user->validade_licenca}}"/>
    </div>
    <div class="form-group">
        <label for="instrutor">Instrutor</label>
        <input
                type="checkbox"
                name="instrutor"
                id="instrutor"
                value="1"
                {{$user->instrutor ?'checked' : ''}}
                onclick="return false;"/><!-- permite que o utilizador nao consiga clicar-->
    </div>
    <div class="form-group">
        <label for="licencaConfirmada">Licença Confirmada</label>
        <input
                type="checkbox"
                name="licenca_confirmada"
                value="1"
                {{$user->licenca_confirmada == 1 ?'checked' : ''}}
                onclick="return false;"/> <!-- PERMITE QUE O UTILIZADOR NAO CONSIGA CLICAR-->
    </div>

    <div class="form-group">
        <!-- MOSTRA LICENÇA DO USER  -->
        <a href="{{route('user.licenca',$user)}}"> Cópia Digital da Licença </a>


    </div>
    <br>

    <h2>Certificado Médico</h2>
    <div class="form-group">
        <label for="inputNrCertificado">Nº de Certificado Médico</label>
        <input disabled
                type="text" class="form-control"
                name="num_certificado" id="nrCertificado"
                placeholder="Número de Certificado Médico" value="{{$user->num_certificado}}"/>
    </div>

    <div class="form-group">
        <label for="inputClasseCertificado">Classe do Certificado</label>
        <select disabled name="classe_certificado">
            <option {{$user->classeCertificado->nome == "Class 1 medical certificate" ? 'selected' : ''}} value="Class 1">Class 1</option>
            <option {{$user->classeCertificado->nome == "Class 2 medical certificate"? 'selected' : ''}} value="Class 2">Class 2</option>
            <option {{$user->classeCertificado->nome == "Light Aircraft Pilot Licence Medical" ? 'selected' : ''}} value="Class 3">Class 3</option>
        </select>
    </div>

    <div class="form-group">
        <label for="expiryDateCert">Validade do Certificado</label>
        <input disabled
                type="date" class="form-control"
                name="validade_certificado" id="expiryDateCert"
                placeholder="Validade do Certificado" value="{{$user->validade_certificado}}"/>
    </div>

    <div class="form-group">
        <label for="certConfirmado">Certificado Confirmado</label>
        <input
                type="checkbox"
                name="certificado_confirmado"
                value="1"
                {{$user->certificado_confirmado == 1 ?'checked' : ''}}
                onclick="return false;"/> <!-- PERMITE QUE O UTILIZADOR NAO CONSIGA CLICAR-->
    </div>

    <div class="form-group">
        <!-- MOSTRA CERTIFICADO DO USER  -->
        <a href="{{route('user.certificado',$user)}}"> Cópia Digital do Certificado </a>

    </div>
    <br>
    <!-- LISTA DE AERONAVES QUE PODE PILOTAR -->
    <h3>Lista de Aeronaves Autorizadas</h3>
    @if(count($user->aeronaves) > 0)
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Matricula</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>Numero de Lugares</td>
                <td>Total Horas</td>
                <td>Preço Hora</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($user->aeronaves as $aeronave)
                @if($aeronave->deleted_at != NULL)
                    @continue
                @endif
                <tr>
                    <td>{{ $aeronave->matricula }}</td>
                    <td>{{ $aeronave->marca }}</td>
                    <td>{{ $aeronave->modelo }}</td>
                    <td>{{ $aeronave->num_lugares }}</td>
                    <td>{{ $aeronave->conta_horas }}</td>
                    <td>{{ $aeronave->preco_hora }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif


@endif
