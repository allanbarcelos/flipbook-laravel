@extends('layouts.app')

@section('content')
<!--{{ Breadcrumbs::render('homeIndex') }}-->
<div class="row">
    <div class="col-md-6">
        <h3>Última edição</h3>
        <hr />
        <div id="the-canvas"></div>
        <button type="button" name="button" class="btn btn-lg btn-block btn-success ">Ler Agora</button>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-chevron-up"></i>
            </h3>
          </div>
          <div class="panel-body">
              <div class="row">
                <div class="col-md-4 offset-md-1">
                  <img src="https://via.placeholder.com/210x297" class="img-fluid img-thumbnail" alt="">
                </div>
                <div class="col-md-4 offset-md-1">
                    <img src="https://via.placeholder.com/210x297" class="img-fluid img-thumbnail" alt="">
                </div>
              </div>
          </div>
          <div class="panel-footer">

          </div>
        </div>
    </div>


</div>

<div id="the-canvas"></div>


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
