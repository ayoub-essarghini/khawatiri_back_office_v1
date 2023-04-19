@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Quotes</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quotes</li>
            </ol>
        </nav>
    </div>
    <div class="row" id="contnt">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <div class="input-group-append col-md-4 col-sm-2">
                        <a href="{{ route('users.add') }}"> <button class="btn btn-inverse-primary btn-fw"> Add
                                User</button></a>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="font-weight: 500; font-size: 1rem">Image</th>
                                <th style="font-weight: 500; font-size: 1rem">Full name</th>
                                <th style="font-weight: 500; font-size: 1rem">Email</th>
                                <th style="font-weight: 500; font-size: 1rem">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $user)
                                <tr id="user{{ $user->id }}">
                                    <td><img src="{{ $user->image_path =="" ? asset('assets/images/admin/avatar.png') : asset('assets/images/admin/' . $user->image_path) }}" alt="image">
                                    </td>
                                    <td>{{ $user->fname . ' ' . $user->lname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button onclick="deleteUser({{$user->id}})" class="btn btn-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete-outline" style="font-size: 1.5rem; color: black"></i>
                                        </button>
                                        <button class="btn btn-primary btn-rounded btn-icon" style="margin-left: 0.5rem">
                                            <a href="{{ route('users.show', $user->id) }}">
                                                <i class="mdi mdi-pencil" style="font-size: 1.5rem; color: black"></i></a>
                                        </button>

                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>



                </div>
            </div>
        </div>

    </div>
    </div>
@endsection

@section('scripts')
    <script>
        var session = "{{ Session::has('success') }}";

        if (session) {
            Swal.fire(
                'Done!',
                "{{ Session('success') }}",
                'success'
            )
        }

        function deleteUser(id) {


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: "/admin/users/delete/" + id,
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.status,
                                'success'
                            )
                            $('#contnt').load(window.location + " #contnt");
                            $('#user' + id).remove().fadeOut("slow");


                        }
                    });



                }
            })

        }
    </script>
@endsection
