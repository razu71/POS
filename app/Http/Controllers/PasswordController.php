<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Mail;

class PasswordController extends Controller
{
    public function showForm()
    {
        return view('passwordReset.email');
    }

    public function sendPasswordResetToken(Request $request)
    {
        $rules = [
            'email' => 'required',
        ];
        $messages = [
            'email|required' => 'Email is required',
        ];
        $this->validate($request, $rules, $messages);
        $user = User::where('email', $request->email)->first();

        if (!$user) return redirect()->back()->with(['dismiss'=>'Email id you entered is not registered!']);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(20),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        $token = $tokenData->token;
        $email = $request->email;

        $message = '';
        $user = User::where(['email' => $request->email])->first();

        if ($user) {
            try{
                Mail::send('passwordReset.sended', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                    $m->from('rir.cse.71@gmail.com', 'POS');
                    $m->to($user->email, $user->name)->subject('Password Reset Link');
                });
                $message = 'Successfully send!!';
            }catch(\Exception $e){
                return redirect()->back()->with('dismiss', 'Mail Sending Error!');
            }
            return redirect()->back()->with('success', $message);
        } else
            $message = 'Email not found';

        return redirect()->back()->with('dismiss', $message);

    }

    public function showPasswordResetForm($token)
    {
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$tokenData) return redirect()->to('login');
        return view('passwordReset.reset', ['token' => $tokenData]);
    }

    public function resetPassword(Request $request, $token)
    {
        $rule = [
            'email' => 'required',
            'resetpassword' => 'required',
            'retyperesetpassword' => 'required',
        ];
        $msg = [
            'email|required' => 'Registered email required',
            'resetpassword|required' => 'Reset Password Required',
            'retyperesetpassword|required' => 'Retype Password Required',
        ];
        $this->validate($request, $rule, $msg);
        $password = $request->resetpassword;
        $retypepassword = $request->retyperesetpassword;
        $user= User::where('email',$request->email)->first();
        if (isset($user)) {
            if ($password == $retypepassword) {
                $tokenData = DB::table('password_resets')->where('token', $token)->first();
                $user = User::where('email', $tokenData->email)->first();
                if (!$user) return redirect()->to('login');
                $user->password = Hash::make($password);
                $user->update();
                Auth::login($user);
                DB::table('password_resets')->where('email', $user->email)->delete();
                return redirect('login');
            }
            return redirect()->back()->with(['dismiss' => 'Password Not Matched!']);
        }
        return redirect()->back()->with(['dismiss' => 'Email Not Matched!']);
    }

}