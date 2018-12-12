@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('adminIndex') }}
<div class="row">
  <div class="col-xl-4 col-sm-6 mb-4">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-users"></i>
        </div>
        <div class="mr-5">26 Clients</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('clientsList') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>
@endsection
