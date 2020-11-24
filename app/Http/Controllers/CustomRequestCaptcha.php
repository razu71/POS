<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomRequestCaptcha extends Controller
{
    public function custom()
    {
        return new \ReCaptcha\RequestMethod\Post();
    }
}
