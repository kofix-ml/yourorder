<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employments = DB::table('staff')
                        ->join('companies', 'staff.company_id', '=', 'companies.id')
                        ->select('staff.*', 'companies.name as companyname', 'companies.logo as companylogo', 'companies.user_id as owner')
                        ->where('staff.user_id', Auth::user()->id)
                        ->get();
        return view('home',compact('employments'));
    }
}
