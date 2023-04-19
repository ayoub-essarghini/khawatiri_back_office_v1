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
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <div class="input-group-append col-md-4 col-sm-2">
                        <a href="{{ route('quotes.add') }}"> <button class="btn btn-inverse-primary btn-fw "> Add
                                Quote</button></a>
                    </div>
                    <hr>
                    <div id="contnt" class="row {{ count($quotes) > 1 ? 'justify-content-center' : '' }} ">

                        @if (count($quotes) == 0)
                            <div class="d-flex justify-content-center p-4" style="color: rgb(99, 98, 98)">
                                <h4> <i class="mdi mdi-alert-circle-outline"></i> Quotes not found</h4>
                            </div>
                        @else
                            @foreach ($quotes as $quote)
                                <blockquote id="quote{{ $quote->id }}"
                                    class="blockquote blockquote-custom bg-white px-2 col-md-4 col-lg-3 col-sm-12 mx-1">
                                    <div class="blockquote-custom-icon  shadow-1-strong"
                                        style="font-size: 2rem; color: rgb(193, 98, 233)">

                                        <i class="mdi mdi-format-quote-close"></i>


                                    </div>
                                    <p class="mb-0 mt-2" style=" text-align: justify; height: 160px; overflow-y: auto;">
                                        {{ $quote->quote }}

                                    </p>
                                    <hr>
                                    <footer class="blockquote-footer pt-2 mt-2">

                                        <button onclick="deleteQuote({{ $quote->id }})"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="mdi mdi-delete-outline" style="font-size: 1.5rem; color: black"></i>
                                        </button>
                                        <button class="btn btn-primary btn-rounded btn-icon" style="margin-left: 0.5rem">
                                            <a href="{{ route('quotes.show', [$quote->id, $quote->category->id]) }}">
                                                <i class="mdi mdi-pencil" style="font-size: 1.5rem; color: black"></i></a>
                                        </button>


                                    </footer>
                                </blockquote>
                            @endforeach
                        @endif

                        <div class="d-flex justify-content-center mt-4"> {!! $quotes->links() !!} </div>




                    </div>



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






        function deleteQuote(id) {


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
                        url: "quotes/delete/" + id,
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
                            $('#quote' + id).remove().fadeOut("slow");
                         

                        }
                    });



                }
            })

        }
    </script>
@endsection
