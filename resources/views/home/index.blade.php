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
    <h3>Última edição</h3>
    <hr />


  </div>


</div>

<div id="the-canvas"></div>


@endsection


@section('scripts')
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<script type="text/javascript">


</script>
@endsection
