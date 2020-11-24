<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;

class AdminController extends Controller
{

    //password Reset
    public function userResetPawssword(Request $request){
        if($request->post()){
            $rules=[
                'current_password'=>'required'
                ,'password'=>'required|confirmed'
                ,'password_confirmation'=>'required'
            ];
            $this->validate($request,$rules);

            if(!Hash::check($request->current_password,Auth::user()->password)){
                $validator = Validator::make([],[]);
                $validator->getMessageBag()->add('current_password', 'Current Password Doesn\'t match');
                return Redirect::back()->withErrors($validator);
            }
            User::where(['id'=>Auth::user()->id])->update(['password'=>bcrypt($request->password)]);
            return redirect()->back()->with(['success'=>'Successfully Updated!']);
        }
        return view('password.list');
    }
    public function adminSetting()
    {
        $data['tab']='header';
        if(isset($_GET['tab'])){
            $data['tab']=$_GET['tab'];
        }
        $data['settings'] = allsetting();

        return view('admin.setting', $data);
    }

    public function editSetting($id)
    {
        $data['editsetting'] = Admin::find($id);
        return view('admin.setting', $data);
    }

    // Header Information Setting
    public function headerSettingSave(Request $request)
    {
        $message = "";
        if (!empty($request->title)) {
            if (!empty($request->title)) {
                Admin::where(['slug' => 'title'])->update(['value' => $request->title]);
            }
            if (!empty($request->image)) {
                Admin::where(['slug' => 'image'])->update(['value' => fileUpload($request->image, 'upload/', '')]);
            }
            if (!empty($request->favicon)) {
                Admin::where(['slug' => 'favicon'])->update(['value' => fileUpload($request->favicon, 'upload/', '')]);
            }
            $message = "Header Updated Successfully!";
            return redirect()->route('adminSetting',['tab'=>'header'])->with(['success' => $message]);
        }

        return redirect()->route('adminSetting',['tab'=>'header'])->with(['dismiss' => 'Nothing to Update']);
    }

    // Copyright text setting
    public function footerSettingSave(Request $request)
    {
        $rules = ['footer' => 'required'];
        $message = ['footer.required' => 'Footer is required'];

        $this->validate($request, $rules, $message);
        if (!empty($request->footer)) {
            Admin::where(['slug' => 'footer'])->update(['value' => $request->footer]);
        }
        return redirect()->route('adminSetting',['tab'=>'footer'])->with('success', 'Footer Updated Successfully');
    }

    // Setting Vat
    public function vatSettingSave(Request $request)
    {
        if(!is_numeric($request->vat)){
            return redirect()->route('adminSetting',['tab'=>'vat'])->with('dismiss', 'Vat must be numeric!');
        }else{
            if (!empty($request->vat)) {
                Admin::where(['slug' => 'vat'])->update(['value' => $request->vat]);
            }
        }

        return redirect()->route('adminSetting',['tab'=>'vat'])->with('success', 'Vat Updated Successfully');
    }

    public function taxSettingSave(Request $request)
    {

        $admin = new Admin();
        $admin->slug = 'tax';
        $admin->value = $request->tax;
        $admin->save();
        return redirect()->route('adminSetting',['tab'=>'tax'])->with('success', 'Tax Added Successfully');
    }

    //Setting Discount for product
    public function discountSettingSave(Request $request)
    {
        if(!is_numeric($request->discount)){
            return redirect()->route('adminSetting',['tab'=>'discount'])->with('dismiss', 'Discount must be numeric!');
        }else {
            if (!empty($request->discount)) {
                Admin::where(['slug' => 'discount'])->update(['value' => $request->discount]);
            }
        }
        return redirect()->route('adminSetting',['tab'=>'discount'])->with('success', 'Updated Successfully');
    }

    // Setting Login Page Image and Captcha enable/disable for login
    public function loginSettingSave(Request $request)
    {
        if (!empty($request->login_image)) {
            Admin::where(['slug' => 'login_image'])->update(['value' => fileUpload($request->login_image, 'upload/', '')]);
        }
        if (!empty($request->captcha)) {
            Admin::where(['slug' => 'captcha'])->update(['value' => $request->captcha]);
        }
        if (!empty($request->captcha_key)) {
            Admin::where(['slug' => 'captcha_key'])->update(['value' => $request->captcha_key]);
        }
        if (!empty($request->captcha_site_key)) {
            Admin::where(['slug' => 'captcha_site_key'])->update(['value' => $request->captcha_site_key]);
        }
        return redirect()->route('adminSetting',['tab'=>'login'])->with('success', 'Updated Successfully');
    }

}
