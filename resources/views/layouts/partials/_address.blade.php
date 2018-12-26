<fieldset>
  <!-- Form Name -->
  <legend>Endereço</legend>
  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-1 control-label" for="cep">CEP</label>
    <div class="col-md-2">
      <input id="cep" name="cep" type="text" placeholder="00000-000" value="{{ old('cep') }}" class="form-control input-md cep">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-1 control-label" for="rua">Rua</label>
    <div class="col-md-4">
      <input id="rua" name="rua" type="text" placeholder="" value="{{ old('rua') }}" class="form-control input-md">
    </div>

    <label class="col-md-1 control-label" for="numero">Número</label>
    <div class="col-md-1">
      <input id="numero" name="numero" type="text" placeholder="" value="{{ old('numero') }}" class="form-control input-md">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-1 control-label" for="bairro">Bairro</label>
    <div class="col-md-6">
      <input id="bairro" name="bairro" type="text" placeholder="" value="{{ old('bairro') }}" class="form-control input-md">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-2 control-label" for="complemento">Complemento</label>
    <div class="col-md-5">
      <input id="complemento" name="complemento" type="text" placeholder="" value="{{ old('complemento') }}" class="form-control input-md">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-1 control-label" for="cidade">Cidade</label>
    <div class="col-md-6">
      <input id="cidade" name="cidade" type="text" placeholder="" value="{{ old('cidade') }}" class="form-control input-md">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group row">
    <label class="col-md-1 control-label" for="uf">UF</label>
    <div class="col-md-1">
      <input id="uf" name="estado" type="text" placeholder="" value="{{ old('uf') }}" class="form-control input-md">
    </div>
  </div>



</fieldset>
