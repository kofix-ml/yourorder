@extends('layouts.app')

@section('content')
    <main>

        <div class="container-fluid mt-5">
            <a href="#" class="btn-floating btn-lg purple-gradient float-right" data-toggle="modal" data-target="#assetchoosing"><i class="fa fa-plus"></i></a>
            @foreach($employments as $employment)
            <!-- Card -->
            <div class="card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                <!-- Content -->
                <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                    <div>
                        <h5 class="pink-text"><i class="fa fa-pie-chart"></i> 
                            @if($employment->owner == Auth::user()->id)
                                Owner
                            @else
                                Employee
                            @endif
                        </h5>
                        <h3 class="card-title pt-2"><strong>{{ $employment->companyname }}</strong></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
                            optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
                            Odit sed qui, dolorum!.</p>
                        <a href="{{ route('stall.show', ['company' => $employment->company_id ])}}" class="btn btn-pink"><i class="fa fa-clone left"></i> Company Dashboard</a>
                    </div>
                </div>
                <!-- Content -->
            </div>
            <!-- Card -->
            <br>
            @endforeach
        </div>
    </main>

    <!-- Central Modal Medium Warning -->
<div class="modal fade" id="assetchoosing" tabindex="-1" role="dialog" aria-labelledby="assetchoose" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Warning</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-question fa-4x mb-3 animated rotateIn"></i>
                    <p>Choose Your Asset</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary-modal"  data-toggle="modal" data-target="#addcommodal" data-dismiss="modal">Create A Company <i class="fa fa-diamond ml-1"></i></a>
                <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-toggle="modal" data-target="#joincommodal" data-dismiss="modal">Join A Company</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Warning-->

@include('addcommodal')
@include('joincommodal')

@endsection
