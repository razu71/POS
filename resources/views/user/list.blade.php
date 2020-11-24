@extends('master.master',['main_menu'=>'users'])
@section('title','Show All Users')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>Users List
                    @if(checkRolePermission(ACTION_USER_ADD,Auth::user()->role,actions()))
                        <a type="button" class="btn btn-info glyphicon glyphicon-plus pull-right" href="{{route('createUser')}}"> Add</a>
                    @endif
                </h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                    <thead>
                    <tr>
                        <th class="desktop">Image</th>
                        <th class="all">User Name</th>
                        <th class="all">Email</th>
                        <th class="mobile-phone-l">Role</th>
                        <th class="mobile-phone-l">Country</th>
                        <th class="mobile-phone-l">National ID</th>
                        <th class="all tc_w10 text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($users[0]))
                        @foreach($users as $user)
                            <tr>
                                <td><img src="{{asset(path_user().$user->image)}}" alt="No Image" width="70" height="50"></td>
                                <td class="table_alignment ">{{ $user->username }}</td>
                                <td class="table_alignment">{{$user->email }}</td>
                                <td class="table_alignment">{{$user->roles->title }}</td>
                                <td class="table_alignment">{{country($user->country_id)}}</td>
                                <td><img src="{{asset(path_user_national_id().$user->national_id)}}" alt="No Image"
                                         width="120px;" height="75px"></td>
                                <td class="table_alignment text-center">
                                    @if(checkRolePermission(ACTION_USER_EDIT,Auth::user()->role,actions()) || checkRolePermission(ACTION_USER_DELETE,Auth::user()->role,actions()))
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            @if(checkRolePermission(ACTION_USER_EDIT,Auth::user()->role,actions()))
                                            <li>
                                                <a href="{{ route('editUser',$user->id)}}" data-toggle="tooltip" title="Click to edit"><i class="fa fa-pencil"></i> Edit</a>
                                            </li>
                                            @endif
                                            @if(checkRolePermission(ACTION_USER_DELETE,Auth::user()->role,actions()))
                                            @if(Auth::user()->id!=$user->id)
                                            <li>
                                                <a href="#{{$user->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                            </li>
                                            @endif
                                            @endif
                                        </ul>
                                    </div>
                                        @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-sm">
                                        <div class="modal-header ">
                                            <h5 class="modal-title">Warning
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure that you want to perform this operation ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            <a href="{{route('deleteUser', $user->id)}}" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr class="row">
                        <tr>
                            <td colspan="2" class="not_found"> No Users yet!</td>
                        </tr>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(isset($users[0]))
                    {{$users->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection