<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::all();
        return view('backend.shipping.index',compact('shippings'));
    }

    public function store(Request $request)
    {
        $shippings = new Shipping();
        $shippings->location = $request->location;
        $shippings->amount = $request->amount;
        $shippings->save();
        return back()->with('success','Shipping address added');
    }

}
