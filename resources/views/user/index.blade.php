@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('user') }}

<div class="row">
  <div class="col-md-6">
    <form class="" action="" method="post">

      {!! Form::open() !!}
      @csrf

      <div class="form-group row">
        <label class="col-md-2 control-label"  for="cpf">CPF</label>
        <div class="col-md-4">
          <input type="text" class="form-control input-md cpf" id="cpf" name="cpf"  value="{{$user->cpf}}" placeholder="000.000.000-00" disabled>
        </div>
        <small class="text-muted"></small>
      </div>


      <div class="form-group row">
        <label class="col-md-2 control-label"  for="name">Nome</label>
        <div class="col-md-10">
          <input type="text" class="form-control input-md" id="name" name="name" placeholder="" value="{{$user->name}}">
        </div>
        <small class="text-muted"></small>
      </div>

      <div class="form-group row">
        <label class="col-md-2 control-label"  for="email">Email</label>
        <div class="col-md-10">
          <input type="email" class="form-control input-md" id="email" name="email" placeholder="" value="{{$user->email}}">
        </div>
        <small class="text-muted"></small>
      </div>
      <fieldset>
        <!-- Form Name -->
        <legend>Telefones</legend>

        <div class="form-group row">
          <label class="col-md-2 control-label" for="telefoneResidencial">Residencial</label>
          <div class="col-md-4">
            <input id="telefoneResidencial" name="telefoneResidencial" type="text"  value="{{$user->landline}}" placeholder="(00) 0000-0000" class="form-control input-md phone_with_ddd">
          </div>
        </div>


        <div class="form-group row">
          <label class="col-md-2 control-label" for="telefoneCelular">Celular</label>
          <div class="col-md-4">
            <input id="telefoneCelular" name="telefoneCelular" type="text" placeholder="(00) 00000-0000"   value="{{$user->cellphone}}"  class="form-control input-md phone_with_ddd">
          </div>
        </div>
      </fieldset>
      <fieldset>
        <!-- Form Name -->
        <legend>Endereço</legend>
        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-2 control-label" for="cep">CEP</label>
          <div class="col-md-3">
            <input id="cep" name="cep" type="text" placeholder="00000-000"  value="{{$user->address->cep}}" class="form-control input-md cep">
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-2 control-label" for="rua">Rua</label>
          <div class="col-md-6">
            <input id="rua" name="rua" type="text" placeholder=""  value="{{$user->address->logradouro}}"  class="form-control input-md">
          </div>

          <label class="col-md-2 control-label" for="numero">Número</label>
          <div class="col-md-2">
            <input id="numero" name="numero" type="text" placeholder=""  value="{{$user->address->numero}}"  class="form-control input-md">
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-2 control-label" for="bairro">Bairro</label>
          <div class="col-md-10">
            <input id="bairro" name="bairro" type="text" placeholder="" value="{{$user->address->bairro}}"  class="form-control input-md">
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-3 control-label" for="complemento">Complemento</label>
          <div class="col-md-9">
            <input id="complemento" name="complemento" type="text" placeholder=""  value="{{$user->address->complemento}}"  class="form-control input-md">
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-2 control-label" for="cidade">Cidade</label>
          <div class="col-md-10">
            <input id="cidade" name="cidade" type="text" placeholder=""  value="{{$user->address->cidade}}" class="form-control input-md">
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group row">
          <label class="col-md-2 control-label" for="uf">UF</label>
          <div class="col-md-2">
            <input id="uf" name="estado" type="text" placeholder=""  value="{{$user->address->uf}}"  class="form-control input-md">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2 control-label" for="uf">&nbsp;</label>
          <div class="col-md-10">
            <button type="submit" class="btn btn-primary float-right">Salvar</button>
          </div>
        </div>

      </fieldset>


      {!! Form::close() !!}

    </form>
  </div>
  <div class="col-md-6">&nbsp;</div>
@endsection
