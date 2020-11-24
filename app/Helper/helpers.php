<?php

use App\Models\Admin;
use Carbon\Carbon;
use App\Models\Role;


function checkRolePermission($role_task, $my_role, $actions)
{
    $role = Role::findOrFail($my_role);
    if (!empty($role->tasks)) {
        if (!empty($role->tasks)) {
            $tasks = array_filter(explode('|', $role->tasks));
        }
        if (isset($tasks)) {
            if (in_array($role_task, $tasks) && array_key_exists($role_task, $actions)) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    return 0;
}


function allsetting($a = null)
{

    if ($a == null) {
        $allsettings = Admin::get();
        if ($allsettings) {
            $output = [];
            foreach ($allsettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } else {
        $allsettings = Admin::where(['slug' => $a])->first();
        if ($allsettings) {
            $output = $allsettings->value;
            return $output;
        }
        return false;
    }
}


//Random string
function randomString($a)
{
    $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $c = strlen($x) - 1;
    $z = '';
    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return $z;
}

// random number
function randomNumber($a = 10)
{
    $x = '0123456789';
    $c = strlen($x) - 1;
    $z = '';
    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return $z;
}

//use array key for validator
function arrKeyOnly($array, $seperator = ',', $exception = [])
{
    $string = '';
    $sep = '';
    foreach ($array as $key => $val) {
        if (in_array($key, $exception) == false) {
            $string .= $sep . $key;
            $sep = $seperator;
        }
    }
    return $string;
}





// Multiple image uploading
function multipleuploadimage($images, $path, $width = null, $height = null)
{
    if (isset($images[0])) {
        $imgNames = [];
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($images as $img) {

            // saving image in target path
            $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
            $imgPath = public_path($path . '/' . $imgName);

            // making image
            $makeImg = Image::make($img);
            if ($width != null && $height != null && is_int($width) && is_int($height)) {
                $makeImg->fit($width, $height);
            }

            if ($makeImg->save($imgPath)) {
                uploadthumb($img, path_prodthumb(), $imgName, 150, 150);
                $imgNames[] = $imgName;
            }
        }

        return $imgNames;
    }

}


function fileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path . '/' . $old_file_name);
    }
    $input['imagename'] = time() . '.' . $new_file->getClientOriginalExtension();
    $destinationPath = public_path($path);
    $new_file->move($destinationPath, $input['imagename']);

    return $input['imagename'];
}

//Image Thumb Upload System
function uploadthumb($img, $path, $name, $width = null, $height = null)
{

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $imgName = $name;
    $imgPath = public_path($path . $imgName);

    // making image
    $makeImg = Image::make($img);
    if ($width != null && $height != null && is_int($width) && is_int($height)) {
        // $makeImg->resize($width, $height);
        $makeImg->fit($width, $height);
    }

    if ($makeImg->save($imgPath)) {
        return $imgName;
    }
    return false;
}

// Remove Uploaded image
function removeuploadedimage($imgName, $path)
{
    $imagePath = public_path($path) . $imgName;
    $deletedImg = File::delete($imagePath);

    if ($deletedImg) {
        return true;
    }
    return false;
}

function removeImage($path, $file_name)
{
    if (isset($file_name) && $file_name != "" && file_exists($path . $file_name)) {
        unlink($path . $file_name);
    }
}


function path_brand()
{
    return 'assets/img/brand/';
}
function path_supplier()
{
    return 'assets/img/supplier/';
}

//user image path
function path_user()
{
    return 'assets/img/user/';
}

function path_user_national_id()
{
    return 'assets/img/user/nid/';
}

function path_setting_logo()
{
    return 'assets/img/setting/logo/';
}

function path_setting_favicon()
{
    return 'assets/img/setting/favicon/';
}

//Product thumb image path
function path_prodthumb()
{
    return 'assets/img/products/thumbs/';
}

//User thumb image path
function path_avatars()
{
    return 'assets/img/avatars/';
}

//Product thumb image path
function path_prodimg()
{
    return 'assets/img/products/';
}

function path_prodgridimg()
{
    return 'assets/img/products/grid/';
}

//Advertisement image path
function path_image()
{
    return 'assets/img/';
}
function path_upload(){
    return 'upload/';
}


//Check Language in controller
function all_settings($a = null)
{
    try {
        if ($a == null) {
            $output = Adminsetting::pluck('value', 'slug');
            if ($output) {
                return $output;
            }
        } else {
            $output = Adminsetting::where(['slug' => $a])->pluck('value', 'slug');
            if ($output) {
                return $output;
            }
        }
    } catch (Exception $e) {
    }
    return false;
}

// Price Calculation
function priceCalculation($price, $discount, $discount_type)
{
    $discounted_price = 0;
    if ($discount_type == DISCOUNT_TYPE_FLAT) {
        $discounted_price = $price - $discount;
    } elseif ($discount_type == DISCOUNT_TYPE_PERCENTAGE) {
        $discounted_price = $price - ($price * $discount / 100);
    }
    return $discounted_price;
}
function discountCalculation($price, $discount, $discount_type){
    $discounted_price = 0;
    if ($discount_type == DISCOUNT_TYPE_FLAT) {
        $discounted_price = $discount;
    } elseif ($discount_type == DISCOUNT_TYPE_PERCENTAGE) {
        $discounted_price = ($price * $discount / 100);
    }
    return $discounted_price;
}


function customRequestCaptcha(){
    return new \ReCaptcha\RequestMethod\Post();
}

// Fime Uploader Input
function InputFileUpload($name){
    $html='';
    $html .='<div class="fileupload fileupload-new" data-provides="fileupload"><div class="input-append">';
    $html .='<div class="uneditable-input"><i class="fa fa-file fileupload-exists"></i><span class="fileupload-preview"></span></div>';
    $html .='<span class="btn btn-default btn-file"><span class="fileupload-exists">Change</span><span class="fileupload-new">Select file</span>';
    $html .='<input type="file" name="login_image" onchange="readURL(this,'.$name.')" /></span>';
    $html .='<a href="#" onclick="removeImage('.$name.')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>';
    $html .='</div><img id="'.$name.'" src="#" class="upload_image" alt="img" /></div>';

    return $html;
}

