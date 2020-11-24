<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{allsetting()['title']}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/loginForm.css')}}">
    <script src="{{asset('assets/js/loginForm.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendors/scrollbar/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}" />
    <!-- main stylesheet css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        body{
            z-index: 9;
            background-color: #fff;
        }
        .forget-pas{
            height: 100vh;
            display: flex;
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
        .forget-password input{
            margin-bottom: 20px;
        }
        .form-content {
            padding: 45px;
            background: #ec0000;
            margin: -1px -41px 40px;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            text-align: center;
        }
        .form-content h2{
            font-size: 35px;
            color: #fff;
            text-transform: capitalize;
            margin-bottom: 20px;
            margin-top: 0;
        }
        .form-content p{
            font-size: 16px;
            line-height: 26px;
            color: #fff;
            margin-bottom: 0;
        }
        .form-box input {
            text-align: left;
        }
        .form-box input[type="password"] {
            border-radius: 0;
            border-top: 1px solid #ccc;
        }
        img{
            border-radius: 50%;
            height: 70px;
            width: 60px;
        }
        @media (max-width: 575.98px) {
            .forget-password{
                width: 300px!important;
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
            <div class="form-content">
                <h2>{{__('Sign in')}}</h2>
                <img src="{{asset('assets/images/avater.jpg')}}" alt="">
            </div>
            
            <div id="output"></div>
            <div class="form-box">
                {{Form::open(['route'=>'loginSave'])}}
                <span class="text-danger">  {{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                <input name="email" type="email" placeholder="Email">
                <input type="password" name="password" placeholder="password">
                <span class="text-danger">  {{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                @if(allsetting()['captcha']==CAPTCHA_ON)
                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? $errors->first('g-recaptcha-response') : '' }}">
                        <div class="g-recaptcha" data-sitekey='{{allsetting()['captcha_key']}}'></div>
                    </div>
                    @if ($errors->has('g-recaptcha-response'))<span
                            class="text-danger"><strong>{{ $errors->first('g-recaptcha-response') }}</strong></span>
                    @endif
                @endif
                <div class="forget-pass">
                    <div class="f_checkbox">
                        <input id="checkbox1" type="checkbox" value="1" name="remember_me">
                        <label class="ml-xs" for="checkbox1"> Keep me logged in</label></div>
                    <a href="{{route('resetpassword')}}">Forgot password?</a>
                </div>
                <button class="btn btn-info btn-block login" type="submit">Login</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
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
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>