@extends('layouts.main')

@section('title', 'Page Title')

@section('sidebar')

@stop

@section('content')
<h1>dashboard</h1>
<a href="/logout">Logout</a>
</br>
</br>
<div class="row">

    <!-- /.col-lg-6 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Login User Details
            </div>
            <!-- /.panel-heading -->


            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th> Name</th>
                                <th>Email</th>
                                <th>Login Count</th>
                                <th>Last Login</th>
                            </tr>
                        </thead>


                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                              
                                <td>{!!\App\Models\User::where(['id' => $user->user_id])->first()->name;!!}</td>
                                <td>{!!\App\Models\User::where(['id' => $user->user_id])->first()->email;!!}</td>
                                <td>{{$user->total}}</td>
                                <td>{!!\App\Models\UserAccess::where(['user_id' => $user->user_id])->orderBy('id', 'DESC')->first()->created_at;!!}</td>
                            </tr>
                            @empty
                            <p>No record found</p>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>


@stop