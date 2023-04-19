@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Users</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item"><a href="{{ route('quotes.index') }}">Quotes</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-pic-wrapper">
                            <div class="pic-holder">
                                <!-- uploaded pic shown here -->
                                <img id="profilePic" class="pic" src="{{ $data->image_path =="" ? asset('assets/images/admin/avatar.png') : asset('assets/images/admin/' . $data->image_path) }}">
                                <input type="hidden" value="{{$data->id}}" name="id">
                                <Input class="uploadProfileInput" type="file" onchange="readURL(this);"
                                    name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                                <label for="newProfilePhoto" class="upload-file-block">
                                    <div class="text-center">
                                        <div class="mb-2">
                                            <i class="fa fa-camera fa-2x"></i>
                                        </div>
                                        <div class="text-uppercase">
                                            Add <br /> Profile Photo
                                        </div>
                                    </div>
                                </label>
                            </div>


                        </div>


                        <div class="form-group">
                            <label for="exampleInputCity1">First name:</label>
                            <input value="{{$data->fname}}" type="text" class="form-control" id="exampleInputCity1" name="fname"
                                placeholder="First name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Last name</label>
                            <input value="{{$data->lname}}"  type="text" class="form-control" id="exampleInputCity1" name="lname"
                                placeholder="Last name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Email</label>
                            <input value="{{$data->email}}"  type="email" class="form-control" name="email" id="exampleInputCity1"
                                placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCity1">Password</label>
                            <input type="text" class="form-control" id="exampleInputCity1" name="password"
                                placeholder="password">
                        </div>
                        

                        <hr>
                        <div class="input-group-append col-md-4 col-sm-2">
                            <button type="submit" class="btn btn-inverse-primary btn-fw ">Update</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profilePic').attr('src', e.target.result).width(150).height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection