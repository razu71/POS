@extends('master.master',['main_menu'=>'users'])
@section('title','Users Profile')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>User Profile<a href="{{route('editUser',$user->id)}}" data-toggle="tooltip"
                                   title="Click to update" class="glyphicon glyphicon-edit  pull-right"></a></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3> </h3>
            <div class="well form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3">Image</label>
                    <div class="col-sm-9">
                        <img src="{{asset(path_user().$user->image)}}"  class="not_found" alt=" No Image!"
                             width="200px;" height="150"></td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">User Name:</label>
                    <div class="col-sm-9">
                        {{$user->username}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">Email:</label>
                    <div class="col-sm-9">
                        {{$user->email}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">Roles:</label>
                    <div class="col-sm-9">
                        {{ $user->roles->title }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">National ID</label>
                    <div class="col-sm-9">
                        <img src="{{asset(path_user_national_id().$user->national_id)}}" class="not_found" alt=" No Image!"
                             width="200px;" height="150">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">Country</label>
                    <div class="col-sm-9">
                        {{country($user->country_id)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection