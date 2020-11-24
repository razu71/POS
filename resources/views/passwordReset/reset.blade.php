<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{allsetting()['title']}}::Reset</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/scrollbar/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <!-- main stylesheet css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <p>Reset your password</p>
                        <div class="panel-body">
                            @if($message=Session::get('message'))
                                <h3 class="text-center text-success">{{ $message }} </h3>
                            @endif
                            {{Form::open(['route' => ['resetPassword', 'token'=>$token->token]])}}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="email" name="email" placeholder="Your registered email"
                                           class="form-control" type="email">
                                </div>
                                @if(session()->has('dismiss'))
                                    <span class="text-danger">{{session()->get('dismiss')}}</span>
                                @endif
                                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('resetpassword') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                    <input type="passsword" name="resetpassword" class="form-control" id="resetpassword"
                                           placeholder="New Password">
                                </div>
                                <span class="text-danger">  {{ $errors->has('resetpassword') ? $errors->first('resetpassword') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('retyperesetpassword') ? 'has-error' : '' }}">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                    <input type="passsword" name="retyperesetpassword" class="form-control"
                                           id="retyperesetpassword" placeholder="Retype Password">
                                </div>
                                <span class="text-danger">  {{ $errors->has('retyperesetpassword') ? $errors->first('retyperesetpassword') : '' }}</span>
                            </div>
                            @if(session()->has('notmatch'))
                                <span class="text-danger">{{session()->get('notmatch')}}</span>
                            @endif
                            <div class="form-group">
                                <input name="recover-submit" class="btn btn-info btn-block" value="Submit"
                                       type="submit">
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jquery plugin -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/dc-custom.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/datatable.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/bootstrap/datatables.bootstrap.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/table-datatables-responsive.js')}}"></script>
{{--<script src="https://maps.googleapis.com/maps/api/js"></script>--}}
{{--			<script src="{{asset('assets/vendors/gmap/map.custom.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/admin.js')}}"></script>
<script src="{{asset('assets/vendors/scrollbar/jquery.nicescroll.min.js')}}')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script>
    var options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300000",
        "hideDuration": "100000",
        "timeOut": "500000",
        "extendedTimeOut": "100000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(!empty(Session::get('success')))
    toastr.success('{{Session::get('success')}}', 'SUCCESS', options);
    @elseif(!empty(Session::get('error')))
    toastr.error('{{Session::get('success')}}', 'ERROR', options)
    @elseif(!empty(Session::get('dismiss')))
    toastr.error('{{Session::get('dismiss')}}', 'ERROR', options)
    @endif
</script>
</body>
</html>