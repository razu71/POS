
Click Here to reset your password:
    <a href="{{route('showPasswordResetForm', ['token'=>$token]).'?email='.urlencode($user->getEmailForPasswordReset())}}">
        <div class="btn btn-default"><button class="btn btn-info">Click Here</button></div>
    </a>
