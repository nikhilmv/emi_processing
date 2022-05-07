@extends('layouts.app')

@section('content')
<div class="container">

    <form method="POST" id="formdata-p" enctype="multipart/form-data" action="{{ route('processdata')}}">
        @csrf

                <div class="card-header">{{ __('EMI Details') }} </div>
                <a href="{{ route('home') }}">{{ __('back') }}</a>

                <div class="card-body">
                    <div class="container">
                        <table class="table">
                          <thead>
                            <tr>
                                @foreach ($table_head as $item)
                                <th>{{$item}}</th>
                                @endforeach

                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($emi_details as $emi_detail)
                              <tr>

                                @foreach ($table_head as $item)

                                <td>
                                    @if ($emi_detail[$item] != null)
                                        {{ $emi_detail[$item] }}
                                    @else
                                        {{"0.00"}}
                                    @endif
                                   </td>

                                @endforeach

                              </tr>
                              @endforeach



                          </tbody>
                        </table>
                      </div>

                </div>


    </form>
</div>
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



