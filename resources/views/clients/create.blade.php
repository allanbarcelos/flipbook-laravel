@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('client_create') }}

<div class="page-header">
  <h3>Adicionar novo cliente</h3>
</div>
<div class="row">
  &nbsp;
</div>

<div class="row">
  <div class="col-md-12">
    {!! Form::open() !!}
    @csrf
    <div class="form-group row">
      <label class="col-md-1 control-label"  for="name">Nome</label>
      <div class="col-md-6">
        <input type="text" class="form-control input-md" id="name" name="name" placeholder="">
      </div>
      <small class="text-muted"></small>
    </div>

    <div class="form-group row">
      <label class="col-md-1 control-label"  for="email">Email</label>
      <div class="col-md-6">
        <input type="email" class="form-control input-md" id="email" name="email" placeholder="">
      </div>
      <small class="text-muted"></small>
    </div>

    <div class="form-group row">
      <label class="col-md-1 control-label"  for="cpf">CPF</label>
      <div class="col-md-2">
        <input type="text" class="form-control input-md cpf" id="cpf" name="cpf" placeholder="000.000.000-00">
      </div>
      <small class="text-muted"></small>
    </div>
    <fieldset>
      <!-- Form Name -->
      <legend>Telefones</legend>

      <div class="form-group row">
        <label class="col-md-1 control-label" for="telefoneResidencial">Residencial</label>
        <div class="col-md-2">
          <input id="telefoneResidencial" name="telefoneResidencial" type="text" placeholder="(00) 0000-0000" class="form-control input-md phone_with_ddd">
        </div>
      </div>


      <div class="form-group row">
        <label class="col-md-1 control-label" for="telefoneCelular">Celular</label>
        <div class="col-md-2">
          <input id="telefoneCelular" name="telefoneCelular" type="text" placeholder="(00) 00000-0000" class="form-control input-md phone_with_ddd">
        </div>
      </div>
    </fieldset>
    <fieldset>
      <!-- Form Name -->
      <legend>Endereço</legend>
      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="cep">CEP</label>
        <div class="col-md-2">
          <input id="cep" name="cep" type="text" placeholder="00000-000" class="form-control input-md cep">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="rua">Rua</label>
        <div class="col-md-4">
          <input id="rua" name="rua" type="text" placeholder="" class="form-control input-md">
        </div>

        <label class="col-md-1 control-label" for="numero">Número</label>
        <div class="col-md-1">
          <input id="numero" name="numero" type="text" placeholder="" class="form-control input-md">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="bairro">Bairro</label>
        <div class="col-md-6">
          <input id="bairro" name="bairro" type="text" placeholder="" class="form-control input-md">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="complemento">Complemento</label>
        <div class="col-md-6">
          <input id="complemento" name="complemento" type="text" placeholder="" class="form-control input-md">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="cidade">Cidade</label>
        <div class="col-md-6">
          <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group row">
        <label class="col-md-1 control-label" for="uf">UF</label>
        <div class="col-md-1">
          <input id="uf" name="estado" type="text" placeholder="" class="form-control input-md">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-1 control-label" for="uf">&nbsp;</label>
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary float-right">Adicionar</button>
        </div>
      </div>

    </fieldset>


    {!! Form::close() !!}
  </div>
</div>

@stop


@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
<script>
$(function() {




  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');

  var  cpf_options = {
    onComplete: function(cpf)
    {
      var numeros, digitos, soma, i, resultado, digitos_iguais;
      digitos_iguais = 1;

      if (cpf.length < 11)
        return false;

      for (i = 0; i < cpf.length - 1; i++)
      {
        if (cpf.charAt(i) != cpf.charAt(i + 1))
        {
          digitos_iguais = 0;
          break;
        }
      }

      if (!digitos_iguais)
      {
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;

        for (i = 10; i > 1; i--)
          soma += numeros.charAt(10 - i) * i;

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if (resultado != digitos.charAt(0))
          return false;

        numeros = cpf.substring(0,10);
        soma = 0;

        for (i = 11; i > 1; i--)
          soma += numeros.charAt(11 - i) * i;

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if (resultado != digitos.charAt(1))
          return false;

        return true;
      }
      else
      {
        return false;
      }
    }

  };

  $('.cpf').mask('000.000.000-00', cpf_options);

  $('.phone').mask('0000-0000');

  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
  };

  $('.phone_with_ddd').mask(SPMaskBehavior, spOptions);
});

$(document).ready(function() {

  function limpa_formulário_cep()
  {
    // Limpa valores do formulário de cep.
    $("#rua").val("").attr("disabled", false);
    $("#bairro").val("").attr("disabled", false);
    $("#cidade").val("").attr("disabled", false);
    $("#uf").val("").attr("disabled", false);
    $("#ibge").val("").attr("disabled", false);
  }

  $("#cep").blur(function() {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != "") {
      var validacep = /^[0-9]{8}$/;
      if(validacep.test(cep)) {
        $("#rua").val("...").attr("disabled", true);
        $("#bairro").val("...").attr("disabled", true);
        $("#cidade").val("...").attr("disabled", true);
        $("#uf").val("...").attr("disabled", true);
        $("#ibge").val("...").attr("disabled", true);
        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
          if (!("erro" in dados)) {
            $("#rua").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);
            $("#ibge").val(dados.ibge);
          }
          else {
            limpa_formulário_cep();
          }
        });
      }
      else {
        limpa_formulário_cep();
      }
    }
    else {
      limpa_formulário_cep();
    }
  });
});
</script>
@stop
