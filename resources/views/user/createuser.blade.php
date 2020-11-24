@extends('master.master',['main_menu'=>'users'])
@php
    if (isset($edituser)){
        $title = ':: Edit User ::';
    }else{
    $title = ':: Add User ::';
    }
@endphp
@section('title',$title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>@if(isset($edituser)) Edit User @else Add User @endif</h3>
            </div>
        </div>
    </div>
    <div class="section-area edituser-btnstyle">
        <div class="row">
            <div class="col-md-12">
                @if($message=Session::get('message'))
                    <h3 class="text-center text-success">{{ $message }} </h3>
                @endif
                {{ Form::open(['route'=>'saveUser','files' => true]) }}
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label for="username">Username Name</label>
                            <input type="text" name="username" class="form-control" id="username"
                                   placeholder="User Name" @if(isset($edituser)) value="{{$edituser->username}}" @endif>
                            <span class="text-danger">  {{ $errors->has('username') ? $errors->first('username') : '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Email" @if(isset($edituser)) value="{{$edituser->email}}" @endif>
                            <span class="text-danger">  {{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                        </div>
                    </div>
                    @if(!isset($edituser))
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="password"
                                       @if(isset($edituser)) value="{{$edituser->password}}" @endif>
                                <span class="text-danger">  {{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select</option>
                                @foreach(country() as $key=>$value)
                                    <option @if(isset($edituser) && $key==$edituser->country_id) selected @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">  {{ $errors->has('country_id') ? $errors->first('country_id') : '' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6 {{ $errors->has('role') ? 'has-error' : ''}}">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="pay-methd-frm form-control">
                                <option value="">Select</option>
                                    @foreach($users as $role)
                                        <option @if(isset($edituser) && $edituser->role==$role->id) selected @endif value="{{$role->id}}">{{$role->title}}</option>
                                    @endforeach
                            </select>
                            <span class="text-danger">  {{ $errors->has('role') ? $errors->first('role') : '' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('national_id') ? 'has-error' : ''}}">
                            <label for="image">Upload Your National ID</label>
                            <span class="file-input file-input-new">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input">
                                            <i class="fa fa-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <span class="btn btn-default btn-file btn-style">
                                            <span class="fileupload-exists change">Change</span>
                                            <span class="fileupload-new"><i class="fa fa-file"></i> Browse</span>
                                            <input type="file" name="national_id" onchange="readURL(this,'national_id')" />
                                        </span>
                                        <a href="#" onclick="removeImage('national_id')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                    <img id="national_id" @if(isset($edituser) && isset($edituser->national_id))src="{{asset(path_user_national_id().$edituser->national_id)}}" @else src="" @endif class="upload_image" alt="img">
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                            <label for="image">Upload Your Image</label>
                            <span class="file-input file-input-new">
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <div class="input-append">
                                      <div class="uneditable-input">
                                          <i class="fa fa-file fileupload-exists"></i>
                                          <span class="fileupload-preview"></span>
                                      </div>
                                      <span class="btn btn-default btn-file">
                                          <span class="fileupload-exists">Change</span>
                                          <span class="fileupload-new"><i class="fa fa-file"></i> Browse</span>
                                          <input type="file" name="image" onchange="readURL(this,'image')" />
                                      </span>
                                      <a href="#" onclick="removeImage('image')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                  </div>
                                  <img id="image" @if(isset($edituser) && isset($edituser->image))src="{{asset(path_user().$edituser->image)}}" @else src="" @endif class="upload_image" alt="img">
                              </div>
                          </span>
                    </div>
                  </div>





                    <div class="col-lg-12">
                        @if(isset($edituser) && !empty($edituser->id))
                            <input type="hidden" name="edit_id" value="{{$edituser->id}}">
                            <button type="submit" class="btn btn-info pull-right">Update</button>
                        @else
                            <button type="submit" class="btn btn-info pull-right">Create</button>
                        @endif
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@section('script')
    {{--<script type="text/javascript">--}}
    {{--var filename = document.getElementAttr('title').files[0].name;--}}
    {{--</script>--}}
@endsection