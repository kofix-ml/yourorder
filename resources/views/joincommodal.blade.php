<!--Modal: Contact form-->
<div class="modal fade" id="joincommodal" tabindex="-1" role="dialog" aria-labelledby="joincommodallabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">
            {!! Form::open(['route' => 'stall.join']) !!}
            <!--Header-->
            <div class="modal-header light-blue darken-3 white-text">
                <h4 class="title"><i class="fa fa-pencil"></i>Join New Company</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body mb-0">
                <div class="md-form form-sm">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" id="company_id" class="form-control" name="company_id">
                    <label for="company_id">Company ID</label>
                </div>
                
                
                {{-- <div class="md-form form-sm">
                    <i class="fa fa-pencil prefix"></i>
                    <textarea type="text" id="form8" class="md-textarea mb-0"></textarea>
                    <label for="form8">Your message</label>
                </div> --}}

                <div class="text-center mt-1-half">
                    <button class="btn btn-info mb-2">Join <i class="fa fa-send ml-1"></i></button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Contact form-->