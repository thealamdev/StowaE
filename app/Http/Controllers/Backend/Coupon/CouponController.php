<?php

namespace App\Http\Controllers\Backend\Coupon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::OrderBy('id','desc')->get();
        // return $coupons;
        return view('backend.coupon.index',compact('coupons'));
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
        //validaiton needed:

        $valided = $request->validate([
            'name'=>'required',
            'amount'=>'required|integer',
            'applicable_amount'=>'required|integer',
            'start_date'=>'required|date',
            'end_date'=>'required|date'
        ]);

        if($valided == true){
            Coupon::create([
                'name'=>$request->name,
                'amount'=>$request->amount,
                'applicable_amount'=>$request->applicable_amount,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
            ]);
        }

        return back()->with('success','Coupon added successfull');
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
