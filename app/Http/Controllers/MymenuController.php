<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MymenuController extends Controller
{    
    public function profile()
    {
        return view('mymenu.profile');
    }
    
    public function account()
    {
        return view('mymenu.account');
    }
    
    public function password()
    {
        return view('mymenu.password');
    }
}
