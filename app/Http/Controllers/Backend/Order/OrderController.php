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
                if ($request->start_date && $request->end_date == null) {
                    $q->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $request->start_date));
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

        // if i want just relationship model and just select their name i can use this query:
        // $order_details = Order::where('id', $id)
        // ->with('shipping_address:id,name', 'user:id,name,email','user.user_info:id,user_id,address,zip')
        // ->select('id', 'transaction_id','user_id', 'order_status', 'total', 'payment_status', 'coupon_name', 'coupon_amount', 'shipping_charge', 'created_at')
        // ->first();


        // $order_details = Order::with(['user' => function($q){
        //     $q->select('id','name');
        // }])
        // ->with(['shipping_address'=>function($q){
        //     $q->select('id','name');
        // }])
        // ->select('id','total','user_id')
        // ->where('id',$id)->first();
        // return $order_details;

        // if you need with relationship and need many query then you can use this way:
        $order_details = Order::where('id', $id)
        ->with([
            'shipping_address' => function ($sh) {
                $sh->select('id','name','order_id', 'phone', 'address', 'city', 'zip');
            },
            'user' => function ($u) {
                $u->select('id','name');
                $u->with('user_info:id,user_id,address,zip,phone,city');
            }
        ])
        ->select('id','transaction_id','user_id', 'order_status', 'total', 'payment_status', 'coupon_name', 'coupon_amount', 'shipping_charge', 'created_at')
        ->first();
    

        $inventory_orders = InventoryOrder::leftJoin('inventories as in', 'inventory_order.inventory_id', '=', 'in.id')
            ->join('products as p', 'in.product_id', '=', 'p.id')
            ->join('sizes as s', 'in.size_id', '=', 's.id')
            ->join('colors as c', 'in.color_id', '=', 'c.id')
            ->where('order_id', $order_details->id)
            ->select(
                'inventory_order.quantity',
                'inventory_order.amount',
                'inventory_order.additional_price',
                'inventory_order.created_at',
                'p.title',
                'p.image',
                's.name as size_name',
                'c.name as color_name'
            )
            ->get();


        return view('backend.order.show', compact('order_details', 'inventory_orders'));
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
