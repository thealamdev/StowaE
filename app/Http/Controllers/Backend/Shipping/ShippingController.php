<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Core\Number;
use Illuminate\Support\Facades\Session;

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
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $total = $cart->sum('total_price');

        $grand_total = $total - (Session::get('coupon')['amount'] ?? 0);

        // $sub_total = $total - $grand_total;

        if($shipping_details->amount > 0){
            $order_total = $total - (Session::get('coupon')['amount'] ?? 0) + $shipping_details->amount;
        }else{
            $order_total = $total - (Session::get('coupon')['amount'] ?? 0) + $shipping_details->amount;
        }
        $data =[
            'order_total' => $order_total,
            'shipping_amount' => $shipping_details->amount,
        ];
        return response()->json($data);
    }



}
