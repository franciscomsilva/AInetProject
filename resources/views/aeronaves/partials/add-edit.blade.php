{{csrf_field()}}

<div class="form-group"> <!-- horas -->
    <label for="inputHoras">Horas</label>
    <input type="text" class="form-control" name="horas" id="inputHoras" value="{{old('conta_horas')}}"/>
</div>
<div class="form-group"> <!-- preco por hora -->
    <label for="inputPrecoHora">Preço por Hora</label>
    <input type="text" class="form-control" name="PrecoHora" id="inputPrecoHora" value="{{old('preco_hora')}}"/>
</div>