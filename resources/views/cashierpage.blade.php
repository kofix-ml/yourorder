<div class="row">
    <div class="col-4">
        <div class="text-center">
            Table List
        </div>
        <br>
        <select name="cash_table" id="cash_table" class="mdb-select colorful-select dropdown-secondary">
            @foreach ($tables as $table)
                <option value="{{$table->id}}">{{$table->label}}</option>
            @endforeach
        </select>
        <button type="button" class="btn purple-gradient btn-lg btn-block" onclick="findunpaidmenu();">Find Menu <i class="fa fa-cutlery ml-1"></i></button>
    </div>
    <div class="col-4" >
        <div class="text-center">
            Cashout menu
        </div>
        <br>
        <div class="card card-body">
            <div class="scroll-box" id="cashmenulist">
                
            </div>
        </div>
        <br>
        <button type="button" class="btn peach-gradient btn-lg  btn-block"><i class="fa fa-shopping-cart ml-1"></i> Total: RM <span id="cashpartialsum"></span></button>
    </div>
    <div class="col-4">
        <div class="text-center">
            Pay With
        </div>
        <br>
        <button class="btn blue-gradient btn-rounded btn-block" data-toggle="modal" data-target="#cashoutmodal">CASH <i class="fa fa-money ml-1"></i><i class="fa fa-money ml-1"></i></button>
    </div>
</div>