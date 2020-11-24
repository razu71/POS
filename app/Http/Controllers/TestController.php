<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    function home()
    {
        return view('master.master');
    }

    public function getDashboard()
    {
        return view('dashboard.dashboard');
    }


}
