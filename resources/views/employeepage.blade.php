@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid mt-5">
            <div class="card card-cascade narrower">

                <!--Card image-->
                <div class="view gradient-card-header purple-gradient">
                    <h2 class="h2-responsive">{{$company->name}}</h2>
                    <p>Created at : {{\Carbon\Carbon::instance($company->created_at)->formatLocalized('%A %d %B %Y')}} </p>
                    <div class="text-center">
                        <!--Facebook-->
                        <a type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fa fa-facebook"></i></a>
                        <!--Twitter-->
                        <a type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fa fa-twitter"></i></a>
                        <!--Google +-->
                        <a href="mailto:{{$company->email}}" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fa fa-google-plus"></i></a>
                    </div>
                </div>
                <!--/Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                    <p class="card-text">
                        Hamriz is a mamak restaurant build along with Hotel above to cater the needs of students within seri iskandar.
                    </p>
                </div>
                <!--/.Card content-->

            </div>

            <br>
            <br>
            
            <ul class="nav md-pills nav-justified pills-secondary">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel11" role="tab">Ordering</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel12" role="tab">Checkout</a>
                </li>
            </ul>
            <!-- Tab panels -->
            <div class="tab-content">

                <!--Panel 1-->
                <div class="tab-pane fade in show active" id="panel11" role="tabpanel">
                    <br>

                    @include('orderingpages')

                </div>
                <!--/.Panel 1-->

                <!--Panel 2-->
                <div class="tab-pane fade" id="panel12" role="tabpanel">
                    <br>

                    @include('cashierpage')

                </div>
                <!--/.Panel 2-->

            </div>
            
        </div>
    </main>
<script>
    // script for ordering
    function passdatatomodal() {
        var icon = '<i class="fa fa-check fa-4x mb-3 animated rotateIn"></i>';
        var table = $('#selecttable_menuform').val();
        var tablename = $("#selecttable_menuform option[value="+table+"]").text();
        var finalmenu = "";
        var checkedValues = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        var checkedtext = $('input:checkbox:checked').map(function() {
            return $(this).attr( "data-join" );
        }).get();
        $.each(checkedtext, function(index, chunk) {
            finalmenu += '<li>'+chunk+'</li>';
        });
        
        $("#confirmtable_id").val(table);
        $("#c_tab_no").empty().append(tablename);
        $("#confirmmenu").val(checkedValues);
        $("#confirmmenulist ul").empty().append(finalmenu);
    }
    function passdatatoeditmodal(editorderid,edittableid,edittablename,editlasttime,editordertakenby,oldmenulist){
        // grab begin
        var icon = '';
        var changedmenulist = "";
        var i = 0;
        $.each(oldmenulist, function(index, chunk) {
            i+=1;
            changedmenulist += '<div class="chip pink lighten-4">'+chunk+'<i class="close fa fa-times"></i><input type="hidden" id="changedmmenu" name="menus['+i+']" value="'+chunk+'"></div>';
        });
        // passing begin
        $('#editorderform').attr('action', '/order/'+editorderid);
        $("#editorderid").val(editorderid);
        $("#c_tab_no_edit").empty().append(edittablename);
        $("#updatedmenulist").empty().append(changedmenulist);

    }
    // .. end script for ordering

    // begin script for cashier
    function findunpaidmenu(){
        var cashingtable = $('#cash_table').val();  
        var cashorderlist = '';
        $.get( "/Api/findorderbytable/"+cashingtable+"/all", function(order) {
            // console.log(order.length);
            console.log(order);
            if (order != "None") {
                for (var i in order) {
                    
                    var cashorderlabel = 'Order No: '+i;
                    var eachmenu = '';
                    for (var menuid in order[i]) {

                        currentmenu = order[i][menuid].split(",");
                        // price = currentmenu[0];
                        // foodname = currentmenu[1];
                        eachmenu += '<div class="form-group"><input type="checkbox" id="cashmenu['+i+']['+menuid+']" foodname="'+currentmenu[1]+'" price="'+currentmenu[0]+'" value="'+i+'|'+menuid+'" orderid="'+i+'"><label for="cashmenu['+i+']['+menuid+']">'+currentmenu[1]+'</label></div>';
                    }       
                    cashorderlist += cashorderlabel+eachmenu;
                }
                $("#cashmenulist").empty().append(cashorderlist);
            }else{
                toastr.warning("No Orders On The Table, Serve Them!!");
            }
        });
        
        
        
        // 
//   .done(function() {
//     alert( "second success" );
//   })
//   .fail(function() {
//     alert( "error" );
//   })
//   .always(function() {
//     alert( "finished" );
//   });
    }
    
</script>
<!-- Central Modal Medium Danger -->
<div class="modal fade" id="confirmordermodal" tabindex="-1" role="dialog" aria-labelledby="confirmordermodallabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        {!! Form::open(['route' => 'order.store']) !!}
        <input type="hidden" value="{{$company->id}}" id="confirmcompany_id" name="company_id" >
        <input type="hidden" value="{{Auth::user()->id}}" id="confirmuser_id" name="user_id" >
        <input type="hidden" id="confirmtable_id" name="table_id" >
        <input type="hidden" id="confirmmenu" name="menus" >
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Confirm Order? <span id="c_tab_no"></span></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div id="confirmmenulist">
                    <ul>
                        
                    </ul>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary-modal">Submit order <i class="fa fa-note ml-1"></i></button>
                <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">Cancel, edit</a>
            </div>
        </div>
        <!--/.Content-->
        {!! Form::close() !!}
    </div>
</div>
<!-- Central Modal Medium Danger-->

<!-- Central Modal Medium Danger -->
<div class="modal fade" id="editordermodal" tabindex="-1" role="dialog" aria-labelledby="editordermodal" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        <form id="editorderform" method="POST">
        {{Form::token()}}
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" value="{{$company->id}}" id="confirmcompany_id" name="company_id" >
        <input type="hidden" value="{{Auth::user()->id}}" id="confirmuser_id" name="user_id" >
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Change Order? Table : <span id="c_tab_no_edit"></span></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div id="updatedmenulist">
                    
                        
                    
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary-modal">Continue order <i class="fa fa-note ml-1"></i></button>
                <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">Cancel changes</a>
            </div>
        </div>
        <!--/.Content-->
        {!! Form::close() !!}
    </div>
</div>


<!-- Central Modal Medium Danger -->
<div class="modal fade" id="cashoutmodal" tabindex="-1" role="dialog" aria-labelledby="cashoutmodal" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        <form id="cashoutmodalform" method="POST">
        {{Form::token()}}
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" value="{{$company->id}}" id="confirmcompany_id" name="company_id" >
        <input type="hidden" value="{{Auth::user()->id}}" id="confirmuser_id" name="user_id" >
        <input type="hidden" id="cashtotalamountpaid" name="cashtotalamountpaid">
        <input type="hidden" id="paidordermenuid" name="paidordermenuid">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Paying...</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <h3 class="text-center" id="modalcashoutvalue">RM 0</h3>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary-modal">Completed <i class="fa fa-card ml-1"></i></button>
                <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">Cancel</a>
            </div>
        </div>
        <!--/.Content-->
        {!! Form::close() !!}
    </div>
</div>

@endsection
