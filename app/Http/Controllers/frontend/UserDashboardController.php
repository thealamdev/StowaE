<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }
    
    public function index(){
        return view('frontend.dashboard.index');
    }
}
