<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('MDB/css/compiled.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    {{-- <link href="{{ asset('MDB/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('MDB/css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('MDB/css/style.css') }}" rel="stylesheet"> --}}
    <style>
        .otherside{
            color:white;
        }
    </style>
</head>

<body style="font-family: 'Lato', sans-serif;" >
    <div style="position: fixed;top: 0px;left: 0px;width: 50%;height: 100%;background-color: #34495E;">
        
    </div>

    <br>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-3"><h4 class="otherside"><em><strong>YourOrder</strong></em></h4></div>
            <div class="col-3"><h4><em><strong>LET'S GET STARTED</strong></em></h4></div>
        </div>
    </div>
        
    <!-- Start your project here-->
    
    <div style="height: 80vh;" id="app">
        <div class="flex-center flex-column">
            <h1 class="animated fadeIn mb-4"><span class="otherside">Easy &</span> Cheap</h1>

            {{-- <h5 class="animated fadeIn mb-3">Thank you for using our product. We're glad you're with us.</h5> --}}

            {{-- <p class="animated fadeIn text-muted">MDB Team</p> --}}
        </div>
    </div>

    <!-- /Start your project here-->
   {{--  <div class="row">
        
            <div class="col-6">
                
            </div>
            <div class="col-3"><h5>SIGNUP?LO5IN</h4></div>
            <div class="col-1"><h5>T</h5></div>
            <div class="col-1"><h5>In</h5></div>
            <div class="col-1"><h5>F</h5></div>
         --}}
    {{-- </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-2"><span class="btn">ABOUT</span></div>
            <div class="col-2"><span class="btn">PRICING</span></div>
            <div class="col-2"><span class="btn">DEMO</span></div>
            <div class="col-3"><button class="btn" data-toggle="modal" data-target="#login" style="background-color: white;color: #34495E!important">SIGNUP?LO5IN</button></div>
            <div class="col-1"><button class="btn" style="background-color: white;color: #34495E!important;border-radius: 25px;padding:8px 12px;"><i class="fa fa-twitter" aria-hidden="true"></i></button></div>
            <div class="col-1"><button class="btn" style="background-color: white;color: #34495E!important;border-radius: 25px;padding:8px 12px;"><i class="fa fa-linkedin" aria-hidden="true"></i></button></div>
            <div class="col-1"><button class="btn" style="background-color: white;color: #34495E!important;border-radius: 25px;padding:8px 12px;"><i class="fa fa-facebook" aria-hidden="true"></i></button></div>
        </div>
    </div>
    <!-- SCRIPTS -->


<!-- Modal -->
<!-- Full Height Modal Right -->
<div class="modal fade right" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p class="h5 text-center mb-4">Sign in</p>
                {!! Form::open(['route' => 'login']) !!}
                <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input placeholder="Your email" type="text" id="defaultForm-email" class="form-control" name="email" value="{{ old('email') }}">
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input placeholder="Your password" type="password" id="defaultForm-pass" class="form-control" name="password" required>
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    <a href="#" class="font-small blue-text d-flex justify-content-end"  data-toggle="modal" data-target="#pwdreset" data-dismiss="modal">Forgot Password?</a>
                    <a href="#" class="font-small grey-text d-flex justify-content-end">Not a member? <span class="blue-text ml-1" data-toggle="modal" data-target="#register" data-dismiss="modal"> Sign Up</span></a>
                </div>
                <div class="text-center">
                    <button class="btn unique-color-dark #1C2331">Login</button>
                </div>
                </form>
            </div>
            <!--Footer-->
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal -->

<!-- Full Height Modal Right -->
<div class="modal fade right" id="pwdreset" tabindex="-1" role="dialog" aria-labelledby="pwdresetlabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100" id="pwdresetlabel">Forgot Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p class="h5 text-center mb-4">Request New Password</p>
                {!! Form::open(['route' => 'login']) !!}
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="text" id="defaultForm-email" class="form-control">
                    <label for="defaultForm-email">Your email</label>
                    <a href="#" class="font-small grey-text d-flex justify-content-end">Not a member? <span class="blue-text ml-1" data-toggle="modal" data-target="#register" data-dismiss="modal"> Sign Up</span></a>
                </div>

                <div class="text-center">
                    <button class="btn unique-color-dark #1C2331">Sent</button>
                </div>
                </form>
            </div>
            <!--Footer-->
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<!-- Full Height Modal Right -->
<div class="modal fade right" id="register" tabindex="-1" role="dialog" aria-labelledby="regmodallebel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100" id="regmodallebel">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p class="h5 text-center mb-4">Sign up</p>
                {!! Form::open(['route' => 'register']) !!}

                <div class="md-form{{ $errors->has('name') ? ' has-error' : '' }}">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input placeholder="Your name" type="text" id="defaultForm-name" class="form-control" name="name"  value="{{ old('name') }}">
                    
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input placeholder="Your email" type="text" id="defaultForm-email" class="form-control" name="email" value="{{ old('email') }}">
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input placeholder="Your password" type="password" id="defaultForm-pass" class="form-control" name="password" required>
                    
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input placeholder="Repeat password" type="password" id="password-confirm" class="form-control" name="password_confirmation" required>
                    
                    <a href="#" class="font-small blue-text d-flex justify-content-end"  data-toggle="modal" data-target="#pwdreset" data-dismiss="modal">Forgot Password?</a>
                </div>

                <div class="text-center">
                    <button class="btn unique-color-dark #1C2331">Sign Me Up!</button>
                </div>
                </form>
            </div>
            <!--Footer-->
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal -->
    <!-- JQuery -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="MDB/js/jquery-3.1.1.min.js"></script> --}}
    <!-- Bootstrap tooltips -->
    {{-- <script type="text/javascript" src="MDB/js/popper.min.js"></script>
    Bootstrap core JavaScript
    <script type="text/javascript" src="MDB/js/bootstrap.min.js"></script> --}}
    <!-- MDB core JavaScript -->
    {{-- <script type="text/javascript" src="MDB/js/mdb.min.js"></script> --}}
    <script src="{{ asset('MDB/js/compiled.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            @if(session('status'))
                toastr.info("{{ session('status') }}");
            @endif
        });
    </script>
</body>

</html>
