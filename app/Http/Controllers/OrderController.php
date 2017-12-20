<?php

namespace App\Http\Controllers;

use App\Order;
use App\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $order = new Order();
        $order->company_id      = $param['company_id'];
        $order->user_id         = $param['user_id'];
        $order->table_id        = $param['table_id'];
        $order->menus           = $param['menus'];
        $order->save();

        return back()->with('status', 'Order In!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order)
    {
        $param = $request->all();
        // dd($param,$order);
        $fixorder = Order::find($order);
        $fixorder->user_id = $param['user_id'];
        $fixorder->menus = implode(",",$param['menus']);
        $fixorder->save();

        return back()->with('status', 'Updated the order!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /*
    *
    *   Changes for cashing
    *   Description :   
    *   Last edited by : Firdausneonexxa
    *
    */
        
    public function cashing (Request $request){
        $parameters = $request->all();

        $ordermenuid = explode(",",$parameters['paidordermenuid']);
        // formatting order
        foreach ($ordermenuid as $key => $value) {
            $ordermenuidadvance[$key] = explode("|",$value);
        }
        // reading and resetting order
        foreach ($ordermenuidadvance as $key => $value) {
            if ($key == 0) {
                $compiledpaid[$value[0]] = $value[1];
            }else{
                // dd($compiledpaid,$key,$value);
                if (array_key_exists($value[0],$compiledpaid)){
                  $compiledpaid[$value[0]] .= ",".$value[1];  
                }else{
                  $compiledpaid[$value[0]] = $value[1];  
                }
            }
        }
        
        foreach ($compiledpaid as $key => $paidmenu) {
            $payingorder = Order::find($key);
            $payingorder->user_id = $parameters['user_id'];
            if ($payingorder->paid != "no") {
                $payingorder->paid .= ",".$paidmenu;
            }else{
                $payingorder->paid = $paidmenu;
            }
            $payingorder->save();   
        }

        return back()->with('status', 'Paid order!');
    }
        

    /*
    *
    *   Changes for findorderbytable
    *   Description :   API build for order by table
    *   Last edited by : Firdausneonexxa
    *
    */
        
    public function findorderbytable ($table,$all){
        $orders = Order::where('table_id',$table)->get();
        // dd($orders);
        
        foreach ($orders as $key => $value) {
            $unpaidmenu = '';
            $allmenuinthisorder = explode(',',$value->menus);
            $allpaidmenuinthisorder = explode(',',$value->paid);
            $iterrateunpaid = 0;
            foreach ($allmenuinthisorder as $menuidori) {
                if (in_array($menuidori, $allpaidmenuinthisorder, TRUE)){
                    
                }else{
                    if ($iterrateunpaid > 0) {
                        $unpaidmenu .= ",".$menuidori;
                    }else{
                        $unpaidmenu .= $menuidori;
                    }
                    $iterrateunpaid += 1;
                }
            }
            // dd($unpaidmenu);
            $ordering[$value->id] = explode(',',$unpaidmenu);
            // dd($ordering[$value->id]);
        }
        // dd($ordering);
        foreach ($ordering as $iter => $menu) {
            if (empty($menu[0])) {
                # code...
            }else{
                foreach ($menu as $menuiter => $menuid) {
                    $menutitle = Menu::where('id',$menuid)->value('name');
                    $menuprice = Menu::where('id',$menuid)->value('price');
                    $compiledmenu[$menuid] = $menuprice.",".$menutitle;
                }
                $compiledorder[$iter] = $compiledmenu;
                $compiledmenu = '';
            }
        }
        
        if (!isset($compiledorder)) {
            $compiledorder = "None";
        }
        // dd(response()->json($orders));
        return response()->json($compiledorder);
    }
        
}
