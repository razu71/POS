<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use Hash;

class AuthController extends Controller
{
    /*
     * Name:razu
     * Date:03-03-2018
     * Change:
     */
    //login form
    public function getLogin()
    {
        if (Auth::user()) {
            return redirect()->route('getDashboard');
        }
        return view('login.login');
    }

    //login data save
    public function loginSave(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Your Email is required!',
            'password.required' => 'The password is required!',
        ];
        if(allsetting()['captcha']==CAPTCHA_ON){
            $rules['g-recaptcha-response']='required|captcha';
            $messages['g-recaptcha-response.required']='Must be verify captcha';
        }
        $this->validate($request, $rules, $messages);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('getDashboard')->with(['success' => 'Successfully Logged In']);
        } else {
            return redirect()->back()->with(['dismiss' => 'Email or Password Not matched']);
        }
    }

    //display all user
    public function displayUser()
    {

        $users = User::orderby('id', 'asc')->paginate(PAGINATE_SMALL);
        return view('user.list', ['users' => $users]);
    }

    //create a user
    public function createUser()
    {
        $users = Role::get();
        return view('user.createuser', ['users' => $users]);
    }

    //update a user
    public function editUser($id)
    {
        $data['edituser'] = User::find($id);
        $user['users'] = Role::get();

        return view('user.createuser', $data, $user);
    }

    //save a user
    public function saveUser(Request $request)
    {
        $message = "";
        $rules = [
            'username' => 'required|max:30',
            'email' => 'required',
            'role' => 'required',
        ];

        $messages = [
            'email.unique' => 'Email must be unique',
            'username.required' => 'Username field must not be empty',
            'role.required' => 'Role field can not be empty',
            'username.max' => 'Username can\'t be more than 30 character',
            'email.required' => 'Email field must not be empty',
        ];
        if (empty($request->edit_id)) {
            $rules['email'] = 'required|unique:users,email';
            $rules['password'] = 'required';
            $messages['password.required']='Password is required';
        }
        $this->validate($request, $rules, $messages);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'country_id' => $request->country_id,
        ];
        if (!empty($request->image)) {
            $data['image'] = fileUpload($request->file('image'), path_user());
        }

        if (!empty($request->national_id)) {
            $data['national_id'] = fileUpload($request->file('national_id'), path_user_national_id());
        }

        if (!empty($request->edit_id)) {
            User::where(['id' => $request->edit_id])->update($data);
        } else {
            $hashpassword = Hash::make($request->password);
            $data['password']=$hashpassword;
            User::create($data);

        }
        if ($request->edit_id) {
            $message = 'Updated Successfully';
            if(Auth::user()->id==$request->edit_id){
                return redirect()->route('profileUser')->with('success', $message);
            }
        } else{
            $message = 'Added Successfully';
        }
        return redirect()->route('displayUser')->with('success', $message);
    }

    //delete a user
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        $message = 'User Deleted successfully';
        return back()->with('message', $message);
    }

    public function userLogout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    //User Profile Function
    public function profileUser()
    {
        $authId = Auth::id();
        $data['user'] = User::where('id', $authId)->with('roles')->first();

        return view('user.userProfile', $data);
    }
}
