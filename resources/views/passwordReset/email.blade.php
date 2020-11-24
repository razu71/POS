<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{allsetting()['title']}}::Password Reset</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets2/css/font-awesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('assets2/css/font-awesome.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.bootstrap.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/vendors/scrollbar/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}" />
    <!-- main stylesheet css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <style>
        body{
            z-index: 9;
            background: url(../public/upload/abc.jpg)no-repeat center center / cover;
        }
        body:before{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #000;
            content: "";
            opacity: .5;
            z-index: -9;
        }
        .forget-password{
            margin: auto;
            width: 470px;
            text-align: left;
            padding: 0px 40px 60px;
            border: 1px solid #e9edef;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 41px rgba(0, 192, 239, 0.15);
        }

        .forget-password input.form-control{
            border: 1px solid #f5efef;
            background: #fafafa;
            margin-bottom: 20px;
            text-align: left;
            height: 45px;
        }
        .forget-password .btn.btn-info.btn-block{
            margin-top: 10px;
            font-weight: 600;
            border-radius: 2px;
            border: solid;
            background: #2a90ea;
            height: 45px;
            outline: none;
            box-shadow: none;
            border: none;
            transition: all 0.3s ease 0s;
        }
        .forget-pas{
            height: 100vh;
            display: flex;
        }
        .form-content {
            padding: 45px;
            background: #1274da;
            margin: -1px -41px 40px;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            text-align: center;
        }
        .form-content h2{
            font-size: 35px;
            color: #fff;
            text-transform: capitalize;
            margin-bottom: 10px;
            margin-top: 0;
        }
        .form-content p{
            font-size: 16px;
            line-height: 26px;
            color: #fff;
            margin-bottom: 0;
        }
        @media (max-width: 575.98px) {
            .forget-password{
                width: 300px !important;
                padding: 0px 20px 40px;
            }
            .form-content {
                padding: 30px;
                background: #1274da;
                margin: -1px -21px 40px;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
            }
        }
    </style>
</head>
<body>
<div class="forget-pas">
    <div class="forget-password">
        <div class="form-content text-center">
            <h2>Forgot Password?</h2>
            <p>You can reset your password here.</p>
        </div>
        {{--<h3><i class="fa fa-lock fa-4x"></i></h3>--}}
        @if($message=Session::get('message'))
        <h4 class="text-center text-success">{{ $message }} </h4>
        @endif

        {{--@if(Session::get('dismiss'))--}}
            {{--<h4 class="text-center text-danger">{{ Session::get('dismiss') }} </h4>--}}
        {{--@endif--}}
        {{Form::open(['route' => 'sendPasswordResetToken'])}}
        <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
            <input id="email" name="email" placeholder="Email address" class="form-control"  type="email">

            <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
            <input name="recover-submit" class="btn btn-info btn-block" value="Send Reset Password Link" type="submit">
        </div>
        {{Form::close()}}
        <div class="forget-pass">
            <a href="{{route('login')}}"><i class="fa fa-angle-double-left"></i> Back to login</a>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('assets/js/dc-custom.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/admin.js')}}"></script>--}}
{{--<script src="{{asset('assets/vendors/scrollbar/jquery.nicescroll.min.js')}}')}}"></script>--}}
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