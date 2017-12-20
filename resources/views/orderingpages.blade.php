<div class="row">
    <div class="col-4">
        <div class="text-center">
            Table List
        </div>
        <br>
        <select name="tables" id="selecttable_menuform" class="mdb-select colorful-select dropdown-secondary">
            @foreach ($tables as $table)
                <option value="{{$table->id}}">{{$table->label}}</option>
            @endforeach
            </select>
        </select>
        
    </div>
    <div class="col-4" >
        <div class="text-center">
            Add Menu
        </div>
        <br>
        <div class="card card-body">
            <div class="scroll-box">
                @foreach ($menus as $menu)
                    <div class="form-group">
                        <input type="checkbox" id="menu['{{$menu->id}}']" value="{{$menu->id}}" data-join="{{$menu->name}}">
                        <label for="menu['{{$menu->id}}']">{{$menu->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="button" class="btn peach-gradient btn-lg" data-toggle="modal" data-target="#confirmordermodal" onclick="passdatatomodal();">Submit Order</button>
    </div>
    <div class="col-4">
        <div class="text-center">
            Recent Order : <span class="red-text"> Today</span>
        </div>
        <br>
        <div class="card card-body" style="padding:0px">
            <div class="scroll-box">
                @foreach (\App\Order::where('company_id',$company->id)->get() as $order)
                    <!--Card Primary-->
                    <div class="card indigo z-depth-2" id="ordering" data-toggle="modal" data-target="#editordermodal" onclick="passdatatoeditmodal({{$order->id}},{{$order->table_id}},'{{\App\Table::where('id',$order->table_id)->value('label')}}','{{$order->created_at}}','{{\App\User::where('id',$order->user_id)->value('name')}}',[{{$order->menus}}]);">
                        <div class="row" style="margin:0px">
                        <a type="button" class="btn btn-info col-2" style="margin:6px 5px;padding:0px">{{\Carbon\Carbon::instance($order->created_at)->format('hi')}}</a>
                        <a type="button" class="btn btn-info col-2" style="margin:6px 5px;padding:0px">{{\App\Table::where('id',$order->table_id)->value('label')}}</a>
                        <a type="button" class="btn btn-info col-3" style="margin:6px 5px;padding:0px"><em>{{\App\User::where('id',$order->user_id)->value('name')}}</em></a>
                        <a type="button" class="btn btn-{{($order->paid = 'no' ? 'danger' : 'success')}} col-3" style="margin:6px 5px;padding:0px"><em>{{($order->paid = 'no' ? 'unpaid' : 'Paid')}}</em></a>
                        </div>
                    </div>
                    <!--/.Card Primary-->
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</div>