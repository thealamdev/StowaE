<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    public function index(){
        $id = auth()->user()->id;
        $orders = Order::where('user_id',auth()->user()->id)->get();
        // return $orders;
        return view('frontend.dashboard.index',compact('orders'));
    }


}
