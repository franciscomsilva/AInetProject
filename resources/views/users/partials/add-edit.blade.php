{{csrf_field()}}
<div class="form-group">
    <label for="photo">Foto</label>

    <!-- MOSTRA FOTO DO USER  -->
    <img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/>

    <!-- BOTAO PARA DAR UPLOAD DA FOTO  -->
    <br/><br/>
    <input type="file" name="image" class="form-control">

</div>
@if(Auth::user()->direcao)
<div class="form-group">
    <label for="nrSocio">Nº de Sócio</label>
    <input
            type="number" class="form-control"
            name="num_socio" id="num_socio"
            placeholder="Nº de Sócio" value="{{old('num_socio', $user->num_socio)}}"/>
</div>

<div class="form-group">
    <label for="inputSexo">Sexo</label>
    <select name="sexo">
        <option {{$user->sexo == "M" ? 'selected' : ''}} value="M">Masculino</option>
        <option {{$user->sexo == "F" ? 'selected' : ''}}  value="F">Feminino</option>
    </select>
</div>
<div class="form-group">
    <label for="inputTSocio">Tipo de Socio</label>
    <select id='select-tipoSocio' name="tipo_socio" onchange="showHideDiv()">
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
           {{$user->ativo == 1 ?'checked' : ''}}/>
</div>
<div class="form-group">
    <label for="inputQuota">Quota em Dia</label>
    <input
            type="checkbox"
            name="quota_paga"
            value="1"
            {{$user->quota_paga == 1 ?'checked' : ''}}/>
</div>
<div class="form-group">
    <label for="inputDirecao">Direção</label>
    <input
            type="checkbox"
            name="direcao"
            value="1"
            {{$user->direcao == 1 ?'checked' : ''}}/>
</div>
@endif
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
<div display="none">{{$route = Route::current()->getName() }}</div>
@if($user->tipo_socio == 'P' || $route == 'user.create')
<div id="div-piloto">
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
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Aluno - Private Pilot License Airplane" ? 'selected' : '' ): ''}} value="ALUNO-PPL(A)">ALUNO-PPL(A)</option>
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Aluno - Piloto de Ultraleve"? 'selected' : ''): ''}} value="ALUNO-PU">ALUNO-PU</option>
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Airline Transport Pilot License" ? 'selected' : '') : ''}} value="ATPL">ATPL</option>
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Comercial Pilot License Airplane" ? 'selected' : '') : ''}} value="CPL(A)">CPL(A)</option>
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Private Pilot License Airplane" ? 'selected' : '') : ''}} value="PPL(A)">PPL(A)</option>
            <option {{$route != 'user.create' ? ($user->tipoLicenca->nome == "Piloto de Ultraleve" ? 'selected' : '') : ''}}  value="PU">PU</option>
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
    @can('confirmLicenca',Auth::user())
        <div class="form-group">
            <label for="licencaConfirmada">Licença Confirmada</label>
            <input
                   type="checkbox"
                   name="licenca_confirmada"
                   value="1"
                   {{$user->licenca_confirmada == 1 ?'checked' : ''}}/>
        </div>
    @endcan
    <div class="form-group">
        <!-- MOSTRA LICENÇA DO USER  -->
        @if($route != 'user.create')
        <a href="{{route('user.licenca',$user)}}"> Cópia Digital da Licença </a>
            <br/><br/>
        @endif

        <!-- BOTAO PARA DAR UPLOAD DA LICENCA  -->
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
            <option {{$route != 'user.create' ? ($user->classeCertificado->nome == "Class 1 medical certificate" ? 'selected' : '') : ''}} value="Class 1">Class 1</option>
            <option {{$route != 'user.create' ? ($user->classeCertificado->nome == "Class 2 medical certificate"? 'selected' : ''): ''}} value="Class 2">Class 2</option>
            <option {{$route != 'user.create' ? ($user->classeCertificado->nome == "Light Aircraft Pilot Licence Medical" ? 'selected' : ''): ''}} value="Class 3">Class 3</option>
        </select>
    </div>

    <div class="form-group">
        <label for="expiryDateCert">Validade do Certificado</label>
        <input
                type="date" class="form-control"
                name="validade_certificado" id="expiryDateCert"
                placeholder="Validade do Certificado" value="{{old('validade_certificado', $user->validade_certificado)}}"/>
    </div>
    @can('confirmCertificado',Auth::user())
        <div class="form-group">
            <label for="certConfirmado">Certificado Confirmado</label>
            <input
                    type="checkbox"
                    name="certificado_confirmado"
                    value="1"
                    {{$user->certificado_confirmado == 1 ?'checked' : ''}}/>
        </div>
    @endcan
    <div class="form-group">
        <!-- MOSTRA CERTIFICADO DO USER  -->
        @if($route != 'user.create')
        <a href="{{route('user.certificado',$user)}}"> Cópia Digital do Certificado </a>
            <br/><br/>
        @endif
        <!-- BOTAO PARA DAR UPLOAD DO CERTIFICADO  -->
        <input type="file" name="certificado" class="form-control">

    </div>
</div>
@endif

<!-- SCRIPT PARA MOSTRAR AREA DE PILOTO-->
<script type="text/javascript">

    function showHideDiv(){

            var selectBox = document.getElementById("select-tipoSocio");
            var divPiloto = document.getElementById("div-piloto");
            var value = selectBox.options[selectBox.selectedIndex].value;
            if(value != 'P'){
                divPiloto.style.display ='none';
            }else{
                divPiloto.style.display ='inline';
            }

    }
</script>