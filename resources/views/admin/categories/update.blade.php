@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Category name </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">update</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <form action="{{ route('categories.update') }}" method="POST">
                        @csrf
                        <div class="input-group mb-4">
                            <div class="col-md-4 mb-2 mb-md-0" style="margin-right: 1rem">
                                <input type="hidden" name="id"  value="{{$data->id}}">
                                <input type="text" class="form-control" placeholder="Category name" name="category_name"
                                    value="{{ $data->category_name }}">
                            </div>

                            <div class="input-group-append col-md-4 col-sm-2">
                                <button type="submit" class="btn btn-inverse-primary btn-fw ">Update</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
