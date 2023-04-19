@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Categories </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">categories</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card p-4">



                <div class="input-group">
                    <div class="col-md-4 mb-1 mb-md-0" style="margin-right: 1rem">
                        <input type="text" class="form-control" name="category_name" id="category_name"
                            placeholder="Category name">

                        <div id="alert" style="height: 30px ; margin-top: 10px;">

                        </div>

                    </div>

                    <div class="input-group-append col-md-4 col-sm-2">
                        <button type="submit" id="submit" class="btn btn-inverse-primary btn-fw ">Add
                            category</button>
                    </div>
                </div>
                <div class="card-body" id="card-body" style="height:auto">


                    <table class="table" id="categoriesTable">
                        <thead>
                            <tr>
                                <th style="font-weight: 500; font-size: 1rem">Category Name</th>
                                <th style="font-weight: 500; font-size: 1rem">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @if (count($categories) == 0)
                                <tr class="d-flex justify-content-center p-4" style="color: rgb(99, 98, 98)">
                                    <td> <i class="mdi mdi-alert-circle-outline"></i> categories not found</td>
                                </tr>
                            @else
                                @foreach ($categories as $category)
                                    <tr id="categ{{ $category->id }}">
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <button onclick="deleteCategory({{ $category->id }})"
                                                class="btn btn-danger btn-rounded btn-icon deleteRecord"
                                                data-id="{{ $category->id }}">
                                         
                                            <a href="{{ /* route('categories.delete',$category->id)*/ '#' }}">
                                                <i class="mdi mdi-delete-outline"
                                                    style="font-size: 1.5rem; color: black"></i></a>
                                            </button>
                                            <button class="btn btn-primary btn-rounded btn-icon"
                                                style="margin-left: 0.5rem">
                                                <a href="{{ route('categories.show', $category->id) }}">
                                                    <i class="mdi mdi-pencil"
                                                        style="font-size: 1.5rem; color: black"></i></a>
                                            </button>

                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>




                    </table>
                    <div class="d-flex justify-content-center mt-4"> {!! $categories->links() !!} </div>
                </div>

            </div>
        </div>

    </div>
    </div>
@endsection

@section('scripts')
    <script>
        var session = "{{ Session()->has('success') }}";

        if (session) {
            Swal.fire(
                'Done!',
                "{{ Session('success') }}",
                'success'
            )
        }
        $(document).ready(function() {
            $(document).on('click', '#submit', function(e) {
                e.preventDefault(e);


                var category_name = $('#category_name').val();
                let token = $('meta[name="csrf_token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/admin/categories/add",
                    data: {
                        _token: token,
                        category_name: category_name
                    },

                    success: function(response) {
                        if (response.status == 400) {
                            $('#alert').html("");
                            $('#alert').addClass(
                                'text-danger justify-content-center');

                            $('#category_name').css('border-color', 'red')


                            $.each(response.errors, function(key, errors_val) {

                                $('#alert').append('<p>' + errors_val + '</p>');

                            });

                        } else {

                            $('#alert').html("");
                            $('#alert').removeClass();
                            $('#category_name').val("");
                            $('#category_name').css('border-color', 'grey')
                            //$('#alert').addClass( 'alert alert-success d-flex justify-content-center');
                            //  $('#alert').append('<h4>' + response.message + '</h4>');
                            Swal.fire(
                                'Added',
                                response.message,
                                'success'
                            )
                            $('#card-body').load(window.location + " #card-body");

                        }
                    }
                });

            })
        });



        function deleteCategory(id) {

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
                        url: "/admin/categories/delete/" + id,
                        data: {
                            _token: $('input[name=_token]').val()
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Catgory has been deleted',
                                'success'
                            )
                            $('#categ' + id).remove().fadeOut("slow");
                            $('#card-body').load(window.location + " #card-body");

                        }
                    });



                }
            })

        }
    </script>
@endsection
