@extends('admin.layouts.admin')

@section('content')

    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Number Of Categories <i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h3>
            <h2 class="mb-5"> {{count($categories)}}</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Number Of Quotes <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
            </h3>
            <h2 class="mb-5">{{count($quotes)}}</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Number Of Users <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
            </h3>
            <h2 class="mb-5">{{count($users)}}</h2>
          </div>
        </div>
      </div>
    </div>
  
@endsection
