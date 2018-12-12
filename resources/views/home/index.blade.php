@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-7">
    <h3>Última edição</h3>
    <hr />
    <div id="the-canvas"></div>
    <button type="button" name="button" class="btn btn-lg btn-block btn-success ">Ler Agora</button>
  </div>

  <div class="col-md-5 bg-secondary">
    <h3 class="text-center"><i class="fa fa-chevron-up"></i></h3>
    <hr />
    <div class="row">
      <div class="col-md-5 offset-md-1 text-center">
        <img src="https://via.placeholder.com/210x297" class="img-fluid img-thumbnail" alt="">
      </div>
      <div class="col-md-5 text-center">
        <img src="https://via.placeholder.com/210x297" class="img-fluid img-thumbnail" alt="">
      </div>
    </div>
    <div class="row">&nbsp;</div>
  </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">

$('.carousel .vertical .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=1;i<2;i++) {
    next=next.next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));
  }
});

</script>
@endsection
