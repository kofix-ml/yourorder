<?php

namespace App\Http\Controllers;

use App\Company;
use App\Staff;
use Illuminate\Http\Request;
use Auth;
use App\Table;
use App\Menu;
use DB;

class CompanyController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $param['user_id'] = Auth::user()->id;
        
        // register new company
        $newcompany = new Company();
        $newcompany->name = $param['companyname']; 
        $newcompany->email = $param['companyemail']; 
        $newcompany->logo = $param['companylogopath']; 
        $newcompany->user_id = $param['user_id'];
        $newcompany->save();
        $request->file('companylogo')->move(base_path() . '/public/company/'.$newcompany->id, $newcompany->logo);

        // add new employment list
        $newowner = new Staff();
        $newowner->user_id = $param['user_id'];
        $newowner->company_id = $newcompany->id;
        $newowner->role = 'owner';
        $newowner->save();

        return back()->with('status','That was great! You created a company');
    }

    public function join(Request $request)
    {

        $param = $request->all();
        $param['user_id'] = Auth::user()->id;

        // add new employment list
        $newowner = new Staff();
        $newowner->user_id = $param['user_id'];
        $newowner->company_id = $param['company_id'];
        $newowner->save();

        return back()->with('status','That was great! Thank you for joining.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        // find user role first

        // if owner
        if ($company->user_id == Auth::user()->id) {
            $tables = Table::where('company_id',$id)->get();
            $menus = Menu::where('company_id',$id)->get();
            $staffs = DB::table('staff')
                        ->join('users', 'staff.user_id', '=', 'users.id')
                        ->join('companies', 'staff.company_id', '=', 'companies.id')
                        ->select('staff.*', 'users.*', 'companies.user_id as owner')
                        ->where('staff.company_id', $id)
                        ->get();
            return view('companypage',compact('company','tables','menus','staffs'));
        }

        $currentuser = DB::table('staff')
                            ->where('staff.company_id', $id)
                            ->where('staff.user_id', Auth::user()->id)
                            ->first();
        // if employee
        if ($currentuser->role == 'employee') {
            $tables = Table::where('company_id',$id)->get();
            $menus = Menu::where('company_id',$id)->get();
            return view('employeepage', compact('company','tables','menus'));
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
