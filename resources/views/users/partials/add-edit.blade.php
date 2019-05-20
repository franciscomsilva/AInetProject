{{csrf_field()}}
<div class="form-group">
    <label for="photo">Foto</label>

    <!-- MOSTRA FOTO DO USER  -->
    <img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/>

    <!-- BOTAO PARA DAR UPLOAD DA FOTO  -->
    <br/><br/>
    <input type="file" name="image" class="form-control">

</div>
<div class="form-group">
    <label for="inputFullname">Nome Completo</label>
    <input
        type="text" class="form-control"
        name="name" id="inputName"
        placeholder="Nome Completo" value="{{old('name', $user->name)}}" />
</div>
<div class="form-group">
    <label for="inputInformalName">Nome Informal</label>
    <input
            type="text" class="form-control"
            name="nome_informal" id="inputName"
            placeholder="Nome Informal" value="{{old('nome_informal', $user->nome_informal)}}" />
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input
        type="email" class="form-control"
        name="email" id="inputEmail"
        placeholder="Endereço Email" value="{{old('email', $user->email)}}"/>
</div>
<div class="form-group">
    <label for="birthDate">Data de Nascimento</label>
    <input
            type="date" class="form-control"
            name="data_nascimento" id="birthDate"
            placeholder="Data de Nascimento" value="{{old('data_nascimento', $user->data_nascimento)}}"/>
</div>
<div class="form-group">
    <label for="nif">NIF</label>
    <input
            type="number" class="form-control"
            name="nif" id="nif"
            placeholder="NIF" value="{{old('nif', $user->nif)}}"/>
</div>
<div class="form-group">
    <label for="phoneNumber">Número de Telefone</label>
    <input
            type="text" class="form-control"
            name="telefone" id="phoneNumber"
            placeholder="Número de Telefone" value="{{old('telefone', $user->telefone)}}"/>
</div>
<div class="form-group">
    <label for="address">Endereço</label>
    <input
            type="text" class="form-control"
            name="endereco" id="address"
            placeholder="Endereço" value="{{old('endereco', $user->endereco)}}"/>
</div>
@if($user->tipo_socio == 'P')
    <br>
    <h1> Piloto </h1>
    <h2>Licença de Piloto</h2>
    <div class="form-group">
        <label for="inputNrLicenca">Nº de Licença</label>
        <input
                type="number" class="form-control"
                name="num_licenca" id="nrLicenca"
                placeholder="Número de Licença" value="{{old('num_licenca', $user->num_licenca)}}"/>
    </div>
    <div class="form-group">
        <label for="inputTLicenca">Tipo de Licença</label>
        <select name="tipo_licenca">
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
        <input
                type="date" class="form-control"
                name="validade_licenca" id="expiryDateLicenca"
                placeholder="Validade da Licença" value="{{old('validade_licenca', $user->validade_licenca)}}"/>
    </div>
    <div class="form-group">
        <label for="instrutor">Instrutor</label>
        <input
                type="checkbox"
                name="instrutor"
                value="1"
                {{$user->instrutor ?'checked' : ''}}/>
    </div>
    <div class="form-group">
        <label for="licencaConfirmada">Licença Confirmada</label>
        <input
                type="checkbox"
                name="licenca_confirmada"
                value="1"
                {{$user->licenca_confirmada == 1 ?'checked' : ''}}/>
    </div>

    <div class="form-group">
        <!-- MOSTRA LICENÇA DO USER  -->
        <a href="{{route('user.licenca',$user)}}"> Cópia Digital da Licença </a>

        <!-- BOTAO PARA DAR UPLOAD DA FOTO  -->
        <br/><br/>
        <input type="file" name="licenca" class="form-control">

    </div>
    <br>

    <h2>Certificado Médico</h2>
    <div class="form-group">
        <label for="inputNrCertificado">Nº de Certificado Médico</label>
        <input
                type="text" class="form-control"
                name="num_certificado" id="nrCertificado"
                placeholder="Número de Certificado Médico" value="{{old('num_certificado', $user->num_certificado)}}"/>
    </div>

    <div class="form-group">
        <label for="inputClasseCertificado">Classe do Certificado</label>
        <select name="classe_certificado">
            <option {{$user->classeCertificado->nome == "Class 1 medical certificate" ? 'selected' : ''}} value="Class 1">Class 1</option>
            <option {{$user->classeCertificado->nome == "Class 2 medical certificate"? 'selected' : ''}} value="Class 2">Class 2</option>
            <option {{$user->classeCertificado->nome == "Light Aircraft Pilot Licence Medical" ? 'selected' : ''}} value="Class 3">Class 3</option>
        </select>
    </div>

    <div class="form-group">
        <label for="expiryDateCert">Validade do Certificado</label>
        <input
                type="date" class="form-control"
                name="validade_certificado" id="expiryDateCert"
                placeholder="Validade do Certificado" value="{{old('validade_certificado', $user->validade_certificado)}}"/>
    </div>

    <div class="form-group">
        <label for="certConfirmado">Certificado Confirmado</label>
        <input
                type="checkbox"
                name="certificado_confirmado"
                value="1"
                {{$user->certificado_confirmado == 1 ?'checked' : ''}}/>
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
