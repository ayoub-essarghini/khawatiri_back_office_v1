@extends('admin.layouts.admin')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Quotes</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item"><a href="{{ route('quotes.index') }}">Quotes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="alert" id="alert"></div>
                   
                    <div class="form-group">
                        <label for="exampleTextarea1">Quote</label>
                        <textarea class="form-control" name="quote" id="quote" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category name</label>
                        <select class="form-control form-control-lg" id="category_name" name="category_name">
                            <option value="" selected>--Choose Category--</option>
                            @foreach ($categories as $categ)
                           
                                 <option value="{{$categ->id}}" style="font-size: 1.3rem;">{{$categ->category_name}}</option>
                            @endforeach
                         
                         
                        </select>
                      </div>
                    <hr>
                    <div class="input-group-append col-md-4 col-sm-2">
                        <button id="submit" class="btn btn-inverse-primary btn-fw ">Add</button>
                    </div>
                    

                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#submit', function(e) {
                e.preventDefault(e);


                var quote = $('#quote').val();
                var category_name = $('#category_name').val();
                let token = $('meta[name="csrf_token"]').attr('content');

               // alert('quote '+quote+'category_id '+category_name);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/admin/quotes/addto",
                    data: {
                        _token: token,
                        category_name: category_name,
                        quote: quote,
                    },

                    success: function(response) {
                        if (response.status == 400) {
                            $('#alert').html("");
                            $('#alert').addClass(
                                'alert alert-danger justify-content-center');

                            $.each(response.errors, function(key, errors_val) {

                                $('#alert').append('<p>' + errors_val + '</p>');

                            });

                        } else {

                            $('#alert').html("");
                            $('#alert').removeClass();
                            $('#quote').val("");
                            //$('#alert').addClass( 'alert alert-success d-flex justify-content-center');
                            //  $('#alert').append('<h4>' + response.message + '</h4>');
                            Swal.fire(
                                'Added',
                                response.message,
                                'success'
                            )

                        }
                    }
                });
            

            })
        });



       
    </script>
@endsection