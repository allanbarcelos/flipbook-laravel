@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('content_create') }}

<div class="row">
  <div class="col-md-12">
    <h3>Adicionar edição</h3>
  </div>
</div>

<div class="alert alert-danger invisible" id="statusValidate">
  <ul class="list-unstyled">
  </ul>
</div>


@if(session()->has('message'))
<div class="alert alert-success">
  {{ session()->get('message') }}
</div>
@endif

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">

        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="pdf_file" name="pdf_file"  accept="application/pdf" aria-describedby="fileHelp" required="required">
                <label class="custom-file-label form-control-file" for="inputGroupFile01" >Selecione um arquivo</label>
              </div>
            </div>
            <small id="fileHelp" class="form-text text-muted">Somente arquivos no formato PDF</small>
          </div>

          <div class="form-group">
            <label for="title">Titulo da capa:</label>
            <input type="text" class="form-control" id="title" name="title" required="required" maxlength="60">
            <small id="titleHelp" class="form-text text-muted">Limitado a 60 caracteres</small>
          </div>

          <div class="form-group">
            <label for="editionDate">Data da edição:</label>
            <input type="date" class="form-control" id="edition_date" name="edition_date" required="required">
          </div>

          <button type="submit" class="btn btn-primary float-md-right">Enviar</button>
        </form>
      </div>
    </div>

    <br />

    <div class="row">
      <div class="col-md-12">
        <div class="progress invisible">
          <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br />

        <div class="row invisible" id="processing">
          <div class="col-md-12">
            <i class="fa fa-cog fa-spin"></i>
            <i class="loader processing"></i>
          </div>
        </div>

        <div class="alert alert-dismissible invisible" id="status" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="fa"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="alert alert-warning" role="alert">
      <h4 class="alert-heading"><i class="fa fa-info-circle"></i> Atenção</h4>
      <hr/>
      <p>
        Nesta versão esta habilitado o envio de apenas um (1) arquivo por vez, para maior comodidade se o arquivo
        seguir o padrão de nomenclatura os campos serão  automaticamente preenchidos.


        <blockquote  class="blockquote">
          <h5> Modelo </h5>
          <code>"Este é um titulo de capa 10-12-2018.pdf"</code>
        </blockquote>

        <img src="{{asset('img/modelo-nomeclatura-pdf.png')}}" class="img-thumbnail" alt="Responsive image">

      </p>
    </div>
  </div>
</div>
@endsection

@section('styles')

@stop

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script type="text/javascript">

document.querySelector("#edition_date").valueAsDate = new Date();

/* show file value after file select */
$('.custom-file-input').on('change',function(){

  var fileName = document.getElementById("pdf_file").files[0].name; // titulo_de_capa-10_12_2018.pdf

  $(this).next('.form-control-file').addClass("selected").html(fileName);

  var regExp = /([a-zA-ZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\ ]+)\ (([1-9]|0[1-9]|[1,2][0-9]|3[0,1])-([1-9]|1[0,1,2])-\d{4})\.(pdf)/;
  var regExpDate = /\ (([1-9]|0[1-9]|[1,2][0-9]|3[0,1])-([1-9]|1[0,1,2])-\d{4})\.(pdf)/;

  if(regExp.test(fileName))
  {
    var result = fileName.split(".");
    var title = result[0].match(/([a-zA-ZzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\ ]+)\ /);
    var date = fileName.match(regExpDate)[1].split("-")
    var toInputDate = new Date(date[2],date[0],date[1]);
    document.getElementById("edition_date").valueAsDate = toInputDate;
    document.getElementById("title").value = title[0];

  }
});

(function() {

  var bar = $('.progress-bar');
  var progress = $(".progress");

  $('form').ajaxForm({
    url: "{{ route('content_create')}}",
    type: 'post',
    beforeSend: function() {
      var percentVal = '0%';
      progress.removeClass('invisible');
      bar.width(percentVal);
      bar.html(percentVal);
      bar.css("width", percentVal);
    },

    uploadProgress: function(event, position, total, percentComplete) {
      var percentVal = percentComplete + '%';
      bar.width(percentVal);
      bar.html(percentVal);
      bar.css("width", percentVal);

      if(percentVal == "100%")
      {
        $("#processing").removeClass("invisible");
      }
    },

    success: function(data) {
      var percentVal = '100%';
      bar.width(percentVal);
      bar.html(percentVal);
      bar.css("width", percentVal);

      $("#processing").addClass("invisible");

      var statusType = data.status.type;

      if(statusType == 'success' || 'error')
      {
        $("#status").removeClass('invisible');

        if(statusType === "success")
        {
          $("#status").addClass("alert-success");
          $("div#status i.fa").addClass("fa-check");
          $("#status").append(data.status.message);
        }
        if(statusType === "error")
        {
          $("#status").addClass("alert-danger");
          $("#status i.fa").addClass("fa-exclamation");
          $("#status").append(data.status.message);
        }
      }

    },

    error:  function(data) {
      $("#statusValidate").removeClass('invisible');
      $.each(data.responseJSON.errors, function( index, value ) {
        $("#statusValidate ul").append("<li>" + value + "</li>");
      });
    },

    complete: function(xhr) {
      console.log("complete");
    }
  });

})();

</script>
@stop
