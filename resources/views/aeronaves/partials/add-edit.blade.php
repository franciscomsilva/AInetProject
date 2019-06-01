{{csrf_field()}}
<!-- tabela aeronaves_valores -->
<div class="form-group"><!-- Matricula -->
    <label for="inputMatricula">Matricula</label>
    <input type="text" maxlength="8" class="form-control" name="matricula" id="inputMatricula" value="{{old('matricula', $aeronave->matricula)}}" placeholder="Matricula da aeronave (8 caracteres)"/> 
</div>
<div class="form-group"> <!-- Marca -->
    <label for="inputMarca">Marca</label>
    <input type="text" class="form-control" name="marca" id="inputmarca" value="{{old('marca', $aeronave->marca)}}" placeholder="Marca da aeronave" />
</div>
<div class="form-group"> <!-- Modelo -->
    <label for="inputModelo">Modelo</label>
    <input type="text" class="form-control" name="modelo" id="inputModelo" value="{{old('modelo', $aeronave->modelo)}}"  placeholder="Modelo da aeronave"/>
</div>

<div class="form-group"> <!-- numero Lugares --> 
    <label for="inputNumLugares">Numero de Lugares</label>
    <input type="number" min="1" class="form-control" name="num_lugares" id="inputNum_lugares" value="{{old('num_lugares', $aeronave->num_lugares)}}"  placeholder="Numero de lugares da aeronave"/>
</div>

<div class="form-group"> <!-- conta horas -->
    <label for="inputHoras">Conta Horas</label>
    <input type="number" min="1" class="form-control" name="conta_horas" id="inputHoras" value="{{old('conta_horas', $aeronave->conta_horas)}}"  placeholder="Conta horas"/>
</div>
<div class="form-group"> <!-- preco por hora -->
    <label for="inputPrecoHora">Preço por Hora</label>
    <input type="number" min="1" class="form-control" name="preco_hora" id="inputPrecoHora" onchange="calcularPrecosUnidades()" value="{{old('preco_hora', $aeronave->preco_hora )}}"  placeholder="Preço por hora"/>
</div>

