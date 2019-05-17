{{csrf_field()}}
<div class="form-group">
    <label for="photo">Foto</label>

    <!-- MOSTRA FOTO DO USER  -->
    <img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" height="50px" width="50px" class="img-thumbnail"/>
    >
    <br/><br/>

</div>
<div class="form-group">
    <label for="inputFullname">Nome Completo</label>
    <input disabled
            type="text" class="form-control"
            name="name" id="inputName"
            placeholder="Nome Completo" value="{{old('name', $user->name)}}" />
</div>
<div class="form-group">
    <label for="inputInformalName">Nome Informal</label>
    <input disabled
            type="text" class="form-control"
            name="nome_informal" id="inputName"
            placeholder="Nome Informal" value="{{old('nome_informal', $user->nome_informal)}}" />
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input disabled
            type="email" class="form-control"
            name="email" id="inputEmail"
            placeholder="Endereço Email" value="{{old('email', $user->email)}}"/>
</div>
<div class="form-group">
    <label for="birthDate">Data de Nascimento</label>
    <input disabled
            type="date" class="form-control"
            name="data_nascimento" id="birthDate"
            placeholder="Data de Nascimento" value="{{old('data_nascimento', $user->data_nascimento)}}"/>
</div>
<div class="form-group">
    <label for="nif">NIF</label>
    <input disabled
            type="number" class="form-control"
            name="nif" id="nif"
            placeholder="NIF" value="{{old('nif', $user->nif)}}"/>
</div>
<div class="form-group">
    <label for="phoneNumber">Número de Telefone</label>
    <input disabled
            type="number" class="form-control"
            name="telefone" id="phoneNumber"
            placeholder="Número de Telefone" value="{{old('telefone', $user->telefone)}}"/>
</div>
<div class="form-group">
    <label for="address">Endereço</label>
    <input disabled
            type="text" class="form-control"
            name="endereco" id="address"
            placeholder="Endereço" value="{{old('endereco', $user->endereco)}}"/>
</div>

@if($user->tipo_socio = 'P')
    <br>
    <h1> Piloto </h1>
    <div class="form-group">
        <label for="nrLicenca">Nº de Licença</label>
        <input disabled
                type="number" class="form-control"
                name="nrLicenca" id="nrLicenca"
                placeholder="Número de Licença" value="{{old('num_licenca', $user->num_licenca)}}"/>
    </div>
    <div class="form-group">
        <label for="tLicenca">Tipo de Licença</label>
        <input disabled
                type="text" class="form-control"
                name="tLicenca" id="tLicenca"
                placeholder="Tipo de Licença" value="{{old('tipo_licenca', $user->tipolicenca)}}"/>
    </div>

    <!-- LISTA DE AERONAVES QUE PODE PILOTAR -->












@endif
