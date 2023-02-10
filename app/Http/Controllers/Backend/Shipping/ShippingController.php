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

    // frontend shipping ajax:
    public function shippingApply(Request $request){
        $shipping_details = Shipping::where('id',$request->shipping_id)->first();
        if($shipping_details->amount > 0){
            $order_total = $shipping_details->amount + $request->total_price;
        }else{
            $order_total = $shipping_details->amount + $request->total_price;
        }
        $data =[
            'order_total' => $order_total,
            'shipping_amount' => $shipping_details->amount,
        ];
        return response()->json($data);
    }

}
