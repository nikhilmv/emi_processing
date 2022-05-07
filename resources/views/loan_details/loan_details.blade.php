@extends('layouts.app')

@section('content')
<div class="container">

    <form method="POST" id="formdata-p" enctype="multipart/form-data" action="{{ route('processdata')}}">
        @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Loan Details') }} </div>
                <a href="{{ route('home') }}">{{ __('back') }}</a>

                <div class="card-body">
                    <div class="container">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>clientid</th>
                              <th>num of payment</th>
                              <th>first payment date</th>
                              <th>last payment date</th>
                              <th>loan amount</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($loan_details as $loan_detail)
                              <tr>
                                <td>{{$loan_detail->clientid}}</td>
                                <td>{{$loan_detail->num_of_payment}}</td>
                                <td>{{$loan_detail->first_payment_date}}</td>
                                <td>{{$loan_detail->last_payment_date}}</td>
                                <td>{{$loan_detail->loan_amount}}</td>

                              </tr>
                              @endforeach



                          </tbody>
                        </table>
                      </div>

                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{--
<script>





$(document).ready(function () {
$('body').on('click', '#process_data', function () {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				},
				url: "/processdata",
				type: 'POST',
				data: $('#formdata-p').serialize(),
				success: function (data) {
					console.log(data.error);

				}
			});


		});

    });
</script> --}}
