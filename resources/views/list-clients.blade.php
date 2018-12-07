@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('listClients') }}
<div class="row">
    <div class="col-md-1">
        <a href="#" class="btn btn-primary" id="addButton">
            <i class="fa fa-edit"></i> Add
        </a>
    </div>
    <div class="col-md-1">
        <a href="#" class="btn btn-warning disabled" id="editButton">
            <i class="fa fa-edit"></i> Edit
        </a>
    </div>
    <div class="col-md-1">
        <a href="#" class="btn btn-danger disabled" id="removeButton">
            <i class="fa fa-trash-alt"></i> Remove
        </a>
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
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
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
        c.splice(c.indexOf(dataId),1)
    else
        c.push(dataId)

    if(c.length > 0)
        $("#removeButton").removeClass("disabled");
    else
        $("#removeButton").addClass("disabled");

    if(c.length == 1)
        $("#editButton").removeClass("disabled");
    else
        $("#editButton").addClass("disabled");

});
</script>
@stop
