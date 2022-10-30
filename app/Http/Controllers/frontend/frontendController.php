<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    //frontend show function:
    public function index(){
        return view('frontend.index');
    }
}
