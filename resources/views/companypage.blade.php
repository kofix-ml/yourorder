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

                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, ex, recusandae. Facere modi
                        sunt, quod quibusdam dignissimos neque rem nihil ratione est placeat vel, natus non quos laudantium
                        veritatis sequi.Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                        laboriosam, nisi ut aliquid ex ea commodi.</p>

                </div>
                <!--/.Card content-->

            </div>
            <br>
            <br>
            <h4 class="text-center">Employee List</h4>
            {!! Form::open(['route' => 'staff.store', 'class' => 'form-inline waves-light waves-light  col-md-auto']) !!}
                <input class="form-control mr-sm-2" type="text" placeholder="User ID" aria-label="user_id" name="user_id">
                <input type="hidden" name="company_id" value="{{$company->id}}">
                <button class="btn aqua-gradient btn-rounded">Add Employee</button>
            {!! Form::close() !!}
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper-2">
                        <!--Table-->
                        <table class="table table-responsive">
                            <thead class="mdb-color lighten-4">
                                <tr>
                                    <th>#</th>
                                    <th class="th-lg">Name</th>
                                    <th class="th-lg">Position</th>
                                    <th class="th-lg">Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $staff)
                                <tr>
                                    <th scope="row">{{$staff->user_id}}</th>
                                    <td>{{$staff->name}}</td>
                                    <td>@if($staff->user_id == $staff->owner) Owner @else Employee @endif</td>
                                    <td>23</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-6">
                    <h4 class="text-center">Tables</h4>
                    {!! Form::open(['route' => 'table.store', 'class' => 'form-inline waves-light waves-light  col-md-auto']) !!}
                        <input class="form-control mr-sm-2" type="text" placeholder="Label" aria-label="Label" name="tablelabel">
                        <input type="hidden" name="company_id" value="{{$company->id}}">
                        <button class="btn aqua-gradient btn-rounded">Add Table</button>
                    {!! Form::close() !!}
                    <div class="row">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Label</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tables as $table)
                                <tr>
                                    <td>{{$table->id}}</td>
                                    <td>{{$table->label}}</td>
                                    <td>
                                        <a class="btn-floating btn-sm purple-gradient"><i class="fa fa-pencil"></i></a>
                                        <a class="btn-floating btn-sm peach-gradient"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <h4 class="text-center">Menus</h4>
                    {!! Form::open(['route' => 'menu.store', 'class' => 'form-inline waves-light waves-light  col-md-auto']) !!}
                        <input class="form-control mr-sm-2" type="text" placeholder="Menu" aria-label="Menu" name="menu">
                        <input class="form-control mr-sm-2" type="text" placeholder="Price" aria-label="Price" name="price">
                        <input type="hidden" name="company_id" value="{{$company->id}}">
                        <button class="btn aqua-gradient btn-rounded">Add Menu</button>
                    {!! Form::close() !!}
                    <div class="row">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr>
                                    <td>{{$menu->id}}</td>
                                    <td>{{$menu->name}}</td>
                                    <td>{{$menu->price}}</td>
                                    <td>
                                        <a class="btn-floating btn-sm purple-gradient"><i class="fa fa-pencil"></i></a>
                                        <a class="btn-floating btn-sm peach-gradient"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

@endsection
