@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('clientsList') }}
<div class="row">
  <div class="col-md-1">
    <a href="{{route('clientsCreate')}}" class="btn btn-primary" id="addButton">
      <i class="fa fa-edit"></i> Add
    </a>
  </div>
  <div class="col-md-1">
    <a href="#" class="btn btn-warning disabled" id="editButton">
      <i class="fa fa-edit"></i> Edit
    </a>
  </div>
  <div class="col-md-1">
    <a href="#" class="btn btn-danger disabled" id="removeButton" data-toggle="modal" data-target="#deleteClientsModal">
      <i class="fa fa-trash-alt"></i> Remove
    </a>
  </div>
  <div class="col-md-7 offset-md-1" id="info">
    &nbsp;
  </div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-hover" id="users-table">
      <thead class="bg-secondary text-white">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr data-id="{{ $user->id }}" class="dataRow">
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->created_at->format('d/m/Y') }}</td>
          <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    {{ $users->links() }}
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteClientsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header danger">
        <h5 class="modal-title" id="exampleModalLabel">Excluir clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          Tem certeza que deseja excluir esses clientes?
        </p>
        <table class="table table-bordered table-hover" id="users-table">
          <thead class="bg-secondary text-white">
            <tr>
              <th>Name</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody id="deleteTableBody">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('clientDelete')}}" method="POST" id="formDeleteClients">
          @csrf
          <button type="submit" class="btn btn-primary">Sim</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop


@section('styles')
@stop

@section('scripts')
<script>
var c = [];
$(".dataRow").click(function () {
  $(this).toggleClass("bg-info text-light");

  var dataId = $(this).attr('data-id');

  if(c.includes(dataId))
  {

    c.splice(c.indexOf(dataId),1);
    $("#deleteTableBody > tr[data-id=\""+dataId+"\"]").remove();
    $("#formClientId"+dataId).remove();

  }else{
    c.push(dataId);
    $(this).clone().appendTo("#deleteTableBody");
    $("#deleteTableBody tr[data-id=\""+dataId+"\"]").removeClass("bg-info text-light");

    $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(1)").remove();
    $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(3)").remove();
    $("#deleteTableBody tr[data-id=\""+dataId+"\"] td:nth-child(3)").remove();

    $("#formDeleteClients").prepend("<input id=\"formClientId"+dataId+"\" type=\"hidden\" name=\"idClient[]\" value=\""+dataId+"\" />");

  }

  if(c.length > 3)
  {
    $("#info").html("<div class=\"alert alert-danger position-fixed offset-md-1\"><i class=\"fa fa-info-circle\"></i> Não selecione mais que <strong>3</strong> clientes para exclusão</div>");
  }
  else{
    $("#info").html("");
  }

  if(c.length > 0 && c.length < 4){
    $("#removeButton").removeClass("disabled");
  }else{
    $("#removeButton").addClass("disabled");
  }
  if(c.length == 1){
    $("#editButton").removeClass("disabled");
  }else{
    $("#editButton").addClass("disabled");
  }
});



$(document).ready(function() {
  // Ajax for our form
  $('form#formDeleteClients').on('submit', function(event){
    event.preventDefault();
    $("#deleteClientsModal").modal('toggle');




    var formData = [];
    $("input[name='idClient[]']").each(function() {
      formData.push($(this).val());
    });

    var CSRF_TOKEN = $('input[name="_token"]').val();

    $.ajax({
      type     : "POST",
      // url      : $(this).attr('action') + '/store',
      url      : $(this).attr('action'),
      data     : {_token: CSRF_TOKEN, 'idClient' : formData},
      dataType: 'JSON',
      cache    : false,
      success  : function(data) {
        $.each( formData, function( index, value ){
          $("tr[data-id=\"" + value + "\"]").fadeOut(250).fadeIn(250, function(){ $(this).remove(); });
        });
        
        $("#info").html("<div class=\"alert alert-success position-fixed offset-md-1\"><i class=\"fa fa-star\"></i> Clientes excluidos com sucesso</div>");

      },
      error: function()
      {
        $.each( formData, function( index, value ){
          $("tr[data-id=\"" + value + "\"]").fadeOut(250).fadeIn(250, function(){
            $("#info").html("<div class=\"alert alert-danger position-fixed offset-md-1\"><i class=\"fa fa-info-circle\"></i> Ocorreu uma falha na exclusão, tente novamente.</div>");
          });
        });
      }
    })
    console.log(formData);
    //return false;
    // alert($(this).attr('action'))
    // alert('form is submited');
  });
});
</script>
@stop
