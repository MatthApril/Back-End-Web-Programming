<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function english(){
        return view('english');
    }

    public function indonesia(){
        return view('indo');
    }
}
