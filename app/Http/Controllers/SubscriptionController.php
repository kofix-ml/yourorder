<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Auth;
use Kidino\Billplz\Billplz;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GCurl;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new GCurl();
        $res = $client->request('GET', 'https://www.billplz.com/api/v3/collections', [
            'auth' => ['ad60048d-2bb5-41a0-b041-579a9dffcad8', '%1e2VFS3jl0X9ijOG6X3F']
        ])->getBody();
        
        // dd($usersubscription->bill_id);
        // echo $res->getStatusCode();
        // // "200"
        // echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'

        $sublistcontents = (string) $res;
        $subdata = json_decode($sublistcontents);
        // dd($subdata->collections); // to see what's inside $subdata
        // {"type":"User"...'
        $subscriptioncollection = [];
        foreach ($subdata->collections as $key => $value) {
            if ($value->status == "active") {
                $subscriptioncollection[$key] = [
                    $value->id, $value->title
                ];
            }
        }
        // dd("haha");
        // get user bill
        $usersubscription = Subscription::where('user_id',Auth::user()->id)->first();
        
        if (is_null($usersubscription)) {
            $currentpackage = "Freemium";
        }else{
            $bill = $client->request('GET', 'https://www.billplz.com/api/v3/bills/'.$usersubscription->bill_id, [
                'auth' => ['ad60048d-2bb5-41a0-b041-579a9dffcad8', '%1e2VFS3jl0X9ijOG6X3F']
            ])->getBody();
            $billcontents = (string) $bill;
            $billdata = json_decode($billcontents);
            if ($billdata->paid) {
                $currentpack = $client->request('GET', 'https://www.billplz.com/api/v3/collections/'.$billdata->collection_id, [
                                    'auth' => ['ad60048d-2bb5-41a0-b041-579a9dffcad8', '%1e2VFS3jl0X9ijOG6X3F']
                                ])->getBody();
                $currentpackcontents = (string) $currentpack;
                $currentpackdata = json_decode($currentpackcontents);
                $currentpackage = $currentpackdata->title;
            }else{
                $currentpackage = "Freemium";
            }
        }
        // $subscription = Subscription::where('user_id',Auth::user()->id)->first();
        return view('subscription',compact('subscriptioncollection','currentpackage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        
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
        $bplz = new Billplz(array('api_key' => 'ad60048d-2bb5-41a0-b041-579a9dffcad8'));
        $bplz->set_data(array(
            'collection_id' => $param['subsplan'],
            'email' => Auth::user()->email,
            'mobile' => '601151384472',
            'name' => Auth::user()->name,
            'due_at' => "2017-12-20",
            'amount' => 2000, // RM20
            'callback_url' => "http://yourwebsite.com/subscription_done"
            // 'redirect_url' => "localhost:8000/subscription"
        ));

        $result = $bplz->create_bill();
        
        list($rheader, $rbody, $rurl) = explode("\n\r\n", $result);
        $bplz_result = json_decode($rurl);
        // dd($result,$bplz_result);
        $subscription = new Subscription();
        $subscription->currentplan = $param['subsplan'];
        $subscription->bill_id = $bplz_result->id;
        $subscription->user_id = Auth::user()->id;
        $subscription->save();
        return redirect($bplz_result->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // dd($request->all(),$id);
        $client = new GCurl();
        $res = $client->request('GET', 'https://www.billplz.com/api/v3/bills/'.$id, [
            'auth' => ['ad60048d-2bb5-41a0-b041-579a9dffcad8', '%1e2VFS3jl0X9ijOG6X3F']
        ])->getBody();

        $contents = (string) $res;
        $data = json_decode($contents);
        dd($data);
        // $bplz = new Billplz(array('api_key' => 'ad60048d-2bb5-41a0-b041-579a9dffcad8'));
        
        // $result = $bplz->get_bill('zontww');
        // list($rheader, $rbody, $rurl) = explode("\n\r\n", $result);
        // $bplz_result = json_decode($rurl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
