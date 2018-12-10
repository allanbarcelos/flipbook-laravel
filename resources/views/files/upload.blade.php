@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('homeIndex') }}

{{ $errors->first('title') }}

<form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile" name="pdf_file"  accept="application/pdf" aria-describedby="fileHelp">
            <label class="custom-file-label form-control-file" for="inputGroupFile01" >Selecione um arquivo</label>
          </div>
        </div>
    </div>

    <div class="form-group">
        <label for="title">Titulo:</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>

@endsection

@section('styles')

@stop

@section('scripts')
<script>
/* show file value after file select */
$('.custom-file-input').on('change',function(){
  var fileName = document.getElementById("exampleInputFile").files[0].name;
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
