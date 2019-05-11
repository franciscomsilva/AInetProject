{{csrf_field()}}

<div class="form-group">
    <label for="inputData">Data</label>
    <input type="date" id="inputData" name="data" class="form-control">
</div>
<div class="form-group">
    <label for="inputHoraDescolagem">Hora Descolagem</label>
    <input type="time" id="inputHoraDescolagem" name="horaDescolagem" class="form-control">
</div>
<div class="form-group">
    <label for="inputNumDiario">Número Diário</label>
    <input type="time" id="inputNumDiario" name="numDiario" class="form-control">
</div>
<div class="form-group">
    <label for="inputNatureza">Natureza</label>
    <select name="natureza" id="inputNatureza" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option <?= old('natureza', $movimento->natureza) ?> value="T">Treino</option>
        <option <?= old('natureza', $movimento->natureza) ?> value="I">Instrução</option>
        <option <?= old('natureza', $movimento->natureza) ?> value="E">Especial</option>
    </select>
</div>

