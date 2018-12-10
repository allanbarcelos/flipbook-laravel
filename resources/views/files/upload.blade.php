@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('homeIndex') }}

<form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" name="profile_image" id="exampleInputFile">
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-default">Submit</button>
</form>

@endsection
