@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Quotes</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item"><a href="{{ route('quotes.index') }}">Quotes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('quotes.update') }}" method="POST">
                        @csrf
                       
                    <div class="form-group">
                        <label for="exampleTextarea1">Quote</label>
                        <input type="hidden" name="id"  value="{{$data->id}}">
                        <textarea class="form-control" name="quote" id="quote" rows="4">{{$data->quote}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category name</label>
                        <select class="form-control form-control-lg" id="category_name" name="category_name">
                            <option value="{{ $data->category->id }}" selected>{{$data->category->category_name}}</option>
                            @foreach ($categories as $categ)
                                <option value="{{ $categ->id }}" style="font-size: 1.3rem;">{{ $categ->category_name }}
                                </option>
                            @endforeach


                        </select>
                    </div>
                    <hr>
                    <div class="input-group-append col-md-4 col-sm-2">
                        <button id="submit" class="btn btn-inverse-primary btn-fw ">Update</button>
                    </div>

                    </form>


                </div>
            </div>
        </div>

    </div>


    </div>
@endsection

@section('scripts')



@endsection
