@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('content') }}

<div class="row">
  <div class="col-md-1">
    <a href="{{route('content_create')}}" class="btn btn-primary" id="addButton">
      <i class="fa fa-edit"></i> Adicionar
    </a>
  </div>
  <div class="col-md-1 offset-md-1">
    <a href="#" class="btn btn-danger disabled" id="removeButton" data-toggle="modal" data-target="#deleteModal">
      <i class="fa fa-trash-alt"></i> Excluir
    </a>
  </div>
  <div class="col-md-7 offset-md-1" id="info">
    &nbsp;
  </div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
  <div class="col-md-12">
    <form class="" action="" method="GET" id="searchForm">
      @csrf
      <div class="form-group">
        <div class="input-group">
          <input type="text"
                 class="form-control border-right-0"
                 aria-label="Default"
                 aria-describedby="inputGroup-sizing-default"
                 placeholder="Search for..." name="search">
          <div class="input-group-append">
            <span class="input-group-text bg-white" id="inputGroup-sizing-default">
              <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
        <p class="help-block">Buscar por titulo, conteudo ou data de inclusão</p>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-hover" id="users-table">
      <thead class="bg-secondary text-white">
        <tr>
          <th>Id</th>
          <th>Path</th>
          <th>Data da edição</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>

        @foreach($content as $cont)
        <tr data-id="{{ $cont->id }}" class="dataRow">
          <td>{{ $cont->id }}</td>
          <td>{{ $cont->path }}</td>
          <td>{{ date('d M Y', strtotime($cont->edition_date)) }}</td>
          <td>{{ $cont->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">

  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header danger">
        <h5 class="modal-title" id="exampleModalLabel">Excluir conteudo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          Tem certeza que deseja excluir essas edições?
        </p>
        <table class="table table-bordered table-hover" id="users-table">
          <thead class="bg-secondary text-white">
            <tr>
              <th>Titulo</th>
              <th>Data publicação</th>
            </tr>
          </thead>
          <tbody id="deleteTableBody">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('content_delete')}}" method="POST" id="formDelete">
          @csrf
          <button type="submit" class="btn btn-primary">Sim</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop


@section('styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
@stop

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="{{asset('js/table-select-delete.js')}}"></script>
@stop
