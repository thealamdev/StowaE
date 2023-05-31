<?php

namespace App\Http\Controllers\Backend\Order;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\InventoryOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $start_date = date('Y-m-d', strtotime($request->start_date));
        // $end_date = date('Y-m-d', strtotime($request->end_date));
        // $start_date = date_format($request->start_date,'Y-m-d');
        // $start_date = date_format($request->end_date,'Y-m-d');
        if ($request->all()) {
            $orders = Order::where(function ($q) use ($request) {
                if ($request->order_id) {
                    $q->where('id', 'LIKE', "%" . $request->order_id . "%");
                }
        
                if ($request->order_status) {
                    $q->where('order_status', $request->order_status);
                }
        
                if ($request->payment_status) {
                    $q->where('payment_status', $request->payment_status);
                }
        
                if ($request->start_date && $request->end_date) {
                    $q->WhereBetween('created_at', [
                        Carbon::createFromFormat('Y-m-d', $request->start_date),
                        Carbon::createFromFormat('Y-m-d', $request->end_date)
                    ]);
                }
                if($request->start_date && $request->end_date == null){
                    $q->whereDate('created_at','>=',Carbon::createFromFormat('Y-m-d',$request->start_date));
                }
            })->paginate(10)->withQueryString();
        } else {
            $orders = Order::paginate(10)->withQueryString();
        }
         
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.order.index');
    }

    
    public function store(Request $request)
    {
        //
    }

     
    public function show($id)
    {
        $order = DB::table('orders as o')
        ->where('o.id',$id)
        ->join('inventory_order as io','o.id' , '=','io.order_id')
        ->join('inventories as in','io.inventory_id' , '=','in.id')
        ->get();

        return $order;
    }

     
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
