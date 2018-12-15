@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('content_create') }}

<div class="row">
  <div class="col-md-12">
    <h3>Adicionar edição</h3>
  </div>
</div>
<div class="row">
  &nbsp;
</div>
@if($errors->any())
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success">
      <ul class="list-unstyled">
        <li>{{ $errors->first('editionDate') }}</li>
        <li>{{ $errors->first('pdf_file') }}</li>
      </ul>
    </div>
  </div>
</div>
    @endif
<div class="row">
  &nbsp;
</div>
<div class="row">
  <div class="col-md-6">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="pdf_file" name="pdf_file"  accept="application/pdf" aria-describedby="fileHelp" required>
                <label class="custom-file-label form-control-file" for="inputGroupFile01" >Selecione um arquivo</label>
              </div>
            </div>
        </div>

        <div class="form-group">
            <label for="editionDate">Data da edição:</label>
            <input type="date" class="form-control" id="edition_date" name="edition_date" required>
        </div>

        <button type="submit" class="btn btn-primary float-md-right">Enviar</button>
    </form>
  </div>
</div>


@endsection

@section('styles')

@stop

@section('scripts')
<script>

document.querySelector("#edition_date").valueAsDate = new Date();

/* show file value after file select */
$('.custom-file-input').on('change',function(){
  var fileName = document.getElementById("pdf_file").files[0].name;
  $(this).next('.form-control-file').addClass("selected").html(fileName);
})

/* method 2 - change file input to text input after selection
$('.custom-file-input').on('change',function(){
    var fileName = $(this).val();
    $(this).next('.form-control-file').hide();
    $(this).toggleClass('form-control custom-file-input').attr('type','text').val(fileName);
})
*/
</script>
@stop
