<?php

namespace App\Http\Controllers\frontend\CouponApply;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CouponApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $total_price = Cart::where('user_id', auth()->user()->id)->sum('total_price');
        $coupon = Coupon::where('name', $request->coupon)->first();

        if (!empty($coupon->name)) {
            if ($coupon->start_date < now()) {
                if ($total_price > $coupon->applicable_amount) {
                    if ($coupon->end_date > now()) {
                        $apply = [
                            'amount' => $coupon->amount,
                            'name' => $coupon->name
                        ];
                        Session::put('coupon', $apply);
                        return back()->with('success', 'Coupon applied');
                    } else {
                        session()->forget('coupon');
                        return back()->with('error', 'Date expire');
                    }
                } else {
                    session()->forget('coupon');
                    return back()->with('error', 'Amount is low');
                }
            } else {
                session()->forget('coupon');
                return back()->with('error', 'Date expireed');
            }
        } else {
            session()->forget('coupon');
            return back()->with('error', 'Coupon is not valid');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
