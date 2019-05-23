{{csrf_field()}}
<!-- tabela aeronaves_valores -->


<div class="form-group"> <!-- conta horas -->
    <label for="inputHoras">Conta Horas</label>
    <input type="number" class="form-control" name="conta_horas" id="inputHoras" value="{{old('conta_horas')}}"/>
</div>
<div class="form-group"> <!-- preco por hora -->
    <label for="inputPrecoHora">Preço por Hora</label>
    <input type="number" class="form-control" name="preco_hora" id="inputPrecoHora" value="{{old('preco_hora')}}"/>
</div>

