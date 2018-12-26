<fieldset>
  <!-- Form Name -->
  <legend>Telefones</legend>

  <div class="form-group row">
    <label class="col-md-1 control-label" for="telefoneResidencial">Residencial</label>
    <div class="col-md-2">
      <input id="telefoneResidencial" name="telefoneResidencial" type="text" placeholder="(00) 0000-0000" value="{{old('telefoneResidencial')}}" class="form-control input-md phone_with_ddd">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-1 control-label" for="telefoneCelular">Celular</label>
    <div class="col-md-2">
      <input id="telefoneCelular" name="telefoneCelular" type="text" placeholder="(00) 00000-0000" value="{{old('telefoneCelular')}}" class="form-control input-md phone_with_ddd">
    </div>
  </div>
</fieldset>
