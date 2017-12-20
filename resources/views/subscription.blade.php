
@extends('layouts.app')

@section('content')
{{-- {{dd($subscriptioncollection)}} --}}
    <main>

        <!--Section: Live preview-->
<section class="form-dark">


    <!--Form without header-->
    <div class="card card-image" style="background-image: url('https://mdbootstrap.com/img/Photo/Others/pricing-table%20(7).jpg');">
        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">

            <!--Header-->
            <div class="text-center">
                <h3 class="white-text mb-5 mt-4 font-bold" style="margin-bottom: 0px !important;"><strong>Your</strong><a class="green-text font-bold"><strong> Subscription </strong></a> <strong>Plan:</strong> </h3>
                <br>
                <div class="chip chip-lg aqua-gradient white-text">
                    {{$currentpackage}}
                </div>
            </div>
            <br>
			{!! Form::open(['route' => 'subscription.store']) !!}
            <!--Body-->
            <!--Blue select-->
            <label for="subsplan"> @if($currentpackage == 'Freemium') Join Us Now!! @else Want to Renew or modify your subscription? @endif</label>
			<select class="mdb-select colorful-select dropdown-success" name="subsplan">
				<option value="0">Get My Plan</option>
				
				@foreach($subscriptioncollection as $subs)
				    @if($subs[1] == $currentpackage)
			    	<option value="{{$subs[0]}}" selected>{{$subs[1]}}</option>
                    @else
                    <option value="{{$subs[0]}}">{{$subs[1]}}</option>
                    @endif
			    @endforeach
			</select>
			<!--/Blue select-->

            {{-- <div class="md-form pb-3">
                <input type="password" id="Form-pass5" class="form-control white-text">
                <label for="Form-pass5">Your password</label>
                <div class="form-group">
                    <input type="checkbox" id="checkbox6">
                    <label for="checkbox6" class="white-text">Accept the<a href="#" class="green-text font-bold"> Terms and Conditions</a></label>
                </div>
            </div> --}}

            <!--Grid row-->
            <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                    <button type="submit" class="btn btn-success btn-block btn-rounded z-depth-1"> @if($currentpackage == 'Freemium') Subscribe @else Harden Up @endif </button>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            <!--Grid row-->
            <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                    <a href="{{route('home')}}" class="btn btn-default btn-block btn-rounded z-depth-1">Return to dashboard</a>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
			{!! Form::close() !!}
            <!--Grid column-->
            {{-- <div class="col-md-12">
                <p class="font-small white-text d-flex justify-content-end">Have an account? <a href="#" class="green-text ml-1 font-bold"> Log in</a></p>
            </div> --}}
            <!--Grid column-->

        </div>
    </div>
    <!--/Form without header-->

</section>
<!--Section: Live preview-->
    </main>


@endsection
