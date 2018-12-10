extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('clientsCreate') }}
<div class="page-header">
   <h3>Adicionar novo cliente</h3>
</div>
<div class="row">
  &nbsp;
</div>

<div class="row">
  <div class="col-md-12">
    <form action="" method="POST">
      @csrf
      <div class="form-group row">
        <label class="col-md-1 control-label"  for="name">Nome</label>
        <div class="col-md-6">
          <input type="text" class="form-control input-md" id="name" placeholder="">
        </div>
        <small class="text-muted"></small>
      </div>

      <div class="form-group row">
        <label class="col-md-1 control-label"  for="email">Email</label>
        <div class="col-md-6">
          <input type="email" class="form-control input-md" id="email" placeholder="">
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


    </form>
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
  $('.cpf').mask('000.000.000-00');
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

           function limpa_formulário_cep() {
               // Limpa valores do formulário de cep.
               $("#rua").val("").attr("disabled", false);
               $("#bairro").val("").attr("disabled", false);
               $("#cidade").val("").attr("disabled", false);
               $("#uf").val("").attr("disabled", false);
               $("#ibge").val("").attr("disabled", false);
           }

           //Quando o campo cep perde o foco.
           $("#cep").blur(function() {

               //Nova variável "cep" somente com dígitos.
               var cep = $(this).val().replace(/\D/g, '');

               //Verifica se campo cep possui valor informado.
               if (cep != "") {

                   //Expressão regular para validar o CEP.
                   var validacep = /^[0-9]{8}$/;

                   //Valida o formato do CEP.
                   if(validacep.test(cep)) {

                       //Preenche os campos com "..." enquanto consulta webservice.
                       $("#rua").val("...").attr("disabled", true);
                       $("#bairro").val("...").attr("disabled", true);
                       $("#cidade").val("...").attr("disabled", true);
                       $("#uf").val("...").attr("disabled", true);
                       $("#ibge").val("...").attr("disabled", true);

                       //Consulta o webservice viacep.com.br/
                       $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                           if (!("erro" in dados)) {
                               //Atualiza os campos com os valores da consulta.
                               $("#rua").val(dados.logradouro);
                               $("#bairro").val(dados.bairro);
                               $("#cidade").val(dados.localidade);
                               $("#uf").val(dados.uf);
                               $("#ibge").val(dados.ibge);
                           } //end if.
                           else {
                               //CEP pesquisado não foi encontrado.
                               limpa_formulário_cep();
                               //alert("CEP não encontrado.");
                           }
                       });
                   } //end if.
                   else {
                       //cep é inválido.
                       limpa_formulário_cep();
                       //alert("Formato de CEP inválido.");
                   }
               } //end if.
               else {
                   //cep sem valor, limpa formulário.
                   limpa_formulário_cep();
               }
           });
       });
</script>
@stop
