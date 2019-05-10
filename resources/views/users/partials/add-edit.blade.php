{{csrf_field()}}
<div class="form-group">
    <label for="photo">Foto</label>

    <!-- MOSTRA FOTO DO USER  -->
    <img src="{{ $user->foto_url == null ? asset('storage/fotos/unknown_user.jpg') : asset('storage/fotos/' . $user->foto_url)}}" class="img-thumbnail"/>

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
            name="name" id="inputName"
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
            name="birthDate" id="birthDate"
            placeholder="Data de Nascimento" value="{{old('email', $user->data_nascimento)}}"/>
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
            type="phone" class="form-control"
            name="phoneNumber" id="phoneNumber"
            placeholder="Número de Telefone" value="{{old('telefone', $user->telefone)}}"/>
</div>
<div class="form-group">
    <label for="address">Endereço</label>
    <input
            type="address" class="form-control"
            name="address" id="address"
            placeholder="Endereço" value="{{old('endereco', $user->endereco)}}"/>
</div>