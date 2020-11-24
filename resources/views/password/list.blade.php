@extends('master.master',['main_menu'=>'Reset Password'])
@section('title','Reset Password')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>Reset Password</h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('userResetPawssword')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }} mb-20">
                                        <label class="col-sm-5 text-center" for="">Current Password</label>
                                        <div class="col-sm-7">
                                            <input type="password" name="current_password" class="form-control">
                                            <span class="text-danger">  {{ $errors->has('current_password') ? $errors->first('current_password') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} mb-20 mt-20">
                                        <label class="col-sm-5 text-center" for="">New Password</label>
                                        <div class="col-sm-7">
                                            <input type="password" name="password" class="form-control">
                                            <span class="text-danger">  {{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }} mt-20">
                                        <label class="col-sm-5 text-center" for="">Confirm Password</label>
                                        <div class="col-sm-7">
                                            <input type="password" name="password_confirmation" class="form-control">
                                            <span class="text-danger">  {{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 mt-20">

                                    <button type="submit" class="btn btn-info pull-right">Reset</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
@endsection