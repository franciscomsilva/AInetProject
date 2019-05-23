{{csrf_field()}}
<!-- tabela aeronaves_valores -->
<div class="form-group"><!-- Matricula -->
    <label for="inputMatricula">Matricula</label>
    <input type="text" class="form-control" name="matricula" id="inputMatricula" value="{{old('matricula')}}" placeholder="{{ $aeronave->matricula }}"/> 
</div>
<div class="form-group"> <!-- Marca -->
    <label for="inputMarca">Marca</label>
    <input type="text" class="form-control" name="marca" id="inputmarca" value="{{old('marca')}}" placeholder="{{ $aeronave->marca }}" />
</div>
<div class="form-group"> <!-- Modelo -->
    <label for="inputModelo">Modelo</label>
    <input type="text" class="form-control" name="modelo" id="inputModelo" value="{{old('modelo')}}"  placeholder="{{ $aeronave->modelo }}"/>
</div>

<div class="form-group"> <!-- numero Lugares --> 
    <label for="inputNumLugares">Numero de Lugares</label>
    <input type="number" class="form-control" name="num_lugares" id="inputNum_lugares" value="{{old('num_lugares')}}"  placeholder="{{ $aeronave->num_lugares }}"/>
</div>

<div class="form-group"> <!-- conta horas -->
    <label for="inputHoras">Conta Horas</label>
    <input type="number" class="form-control" name="conta_horas" id="inputHoras" value="{{old('conta_horas')}}"  placeholder="{{ $aeronave->conta_horas }}"/>
</div>
<div class="form-group"> <!-- preco por hora -->
    <label for="inputPrecoHora">Preço por Hora</label>
    <input type="number" class="form-control" name="preco_hora" id="inputPrecoHora" value="{{old('preco_hora')}}"  placeholder="{{ $aeronave->preco_hora }}"/>
</div>

