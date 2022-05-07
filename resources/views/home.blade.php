@extends('layouts.app')

@section('content')
<div class="container">

    <form method="POST" id="formdata-p" enctype="multipart/form-data" action="{{ route('processdata')}}">
        @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">


                    <input id="process_data" class="btn btn-light waves-effect waves-light btn-semi-dark" type="submit">



                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>





// $(document).ready(function () {
// $('body').on('click', '#process_data', function () {
// 			$.ajax({
// 				headers: {
// 					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
// 				},
// 				url: "/processdata",
// 				type: 'POST',
// 				data: $('#formdata-p').serialize(),
// 				success: function (data) {
// 					console.log(data.error);

// 				}
// 			});


// 		});

//     });
// </script>
