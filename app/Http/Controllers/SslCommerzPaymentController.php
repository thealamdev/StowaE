<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\User_info;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Shipping_address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Invoice;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {
        $validate = $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required',
            'billing_phone' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'nullable',
            'billing_postcode' => 'nullable'
        ]);

        User_info::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'phone' => $request->billing_phone,
                'address' => $request->billing_address,
                'city' => $request->billing_city,
                'zip' => $request->billing_postcode,
                'photo' => 'user.jpg',
            ]
        );

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $sub_total = 0;
        foreach ($carts as $cart) {

            if ($cart->inventory->quantity < $cart->quantity) {
                return back()->with('error', 'Stock over');
            } else {
                $sub_total += (($cart->inventory->product->sale_price ?? $cart->inventory->product->price) + ($cart->inventory->additional_price ?? 0)) * $cart->quantity;
            }
        }
        $sub_total;
        $total = $sub_total - (Session::has('coupon') ? Session::get('coupon')['amount'] : 0) + (Session::has('shipping_amount') ? Session::get('shipping_amount')  : 0);

        $post_data = array();
        $post_data['total_amount'] = $total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        // $order = new Order();
        // $order->user_id = auth()->user()->id;
        // $order->transaction_id = $post_data['tran_id'];
        // $order->total = $post_data['total_amount'];
        // $order->order_status = 'Pending';
        // $order->coupon_name = Session::has('coupon') ? Session::get('coupon')['name']:'';
        // $order->coupon_amount = Session::has('coupon') ? Session::get('coupon')['amount']:0;
        // $order->shipping_charge = Session::has('shipping_charge') ? Session::get('shipping_charge'):0;
        // $order->status = true;
        // $order->save();
        // foreach($carts as $cart){
        //     $order->inventory_order()->attach($cart->inventory_id);
        //     $order->order_id = $order->id;
        //     $order->quantity = $cart->quantity;

        // }
        // $order->save();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->transaction_id = $post_data['tran_id'];
        $order->total = $post_data['total_amount'];
        $order->order_status = 'Pending';
        $order->coupon_name = Session::has('coupon') ? Session::get('coupon')['name'] : '';
        $order->coupon_amount = Session::has('coupon') ? Session::get('coupon')['amount'] : 0;
        $order->shipping_charge = Session::has('shipping_amount') ? Session::get('shipping_amount') : 0;
        $order->payment_status = 'unpaid';
        $order->order_note = $request->order_note;
        $order->save();
        foreach ($carts as $cart) {
            $order->inventory_order()->attach($cart->inventory_id, ['quantity' => $cart->quantity, 'amount' => $cart->inventory->product->sale_price ?? $cart->inventory->product->price, 'additional_price' => $cart->inventory->additional_price ?? 0]);
        }


        if ($request->ship_to_different_address == true) {
            $shipping = Shipping_address::create([
                'order_id' => $order->id,
                'name' => $request->shipping_name,
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'zip' => $request->shipping_zip,
                'phone' => $request->shipping_phone,
            ]);
        }


        // $order = Order::create([
        //     'user_id' => auth()->user()->id,
        //     'transaction_id' => $post_data['tran_id'],
        //     'total' => $post_data['total_amount'],
        //     'order_status' => 'Pending',
        //     'coupon_name' => Session::has('coupon') ? Session::get('coupon')['name']:'',
        //     'coupon_amount' => Session::has('coupon') ? Session::get('coupon')['amount']:0,
        //     'shipping_charge' => Session::has('shipping_charge') ? Session::get('shipping_charge'):0,
        //     'status' => true,
        // ]);


        // if($order){
        //     $order_inventory = InventoryOrder::
        // }
        // return back()->with('success', 'Usr info update');
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.



        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        // return redirect(route('success'));
    }


    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = Order::where('transaction_id', $tran_id)->select('id','transaction_id', 'order_status', 'total', 'payment_status')->first();
        $inventory_orders  = DB::table('inventory_order')
            ->where('order_id',$order_details->id)
            ->get();

            // return $inventory_orders;
        
        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount);
            
            
            if ($validation) {
                 
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'order_status' => 'Processing',
                        'payment_status' => 'Paid'
                    ]); 

                    foreach($inventory_orders as $inventory_order){
                        $inventory = Inventory::where('id',$inventory_order->inventory_id)->decrement('quantity');
                        $card = Cart::where('inventory_id',$inventory_order->inventory_id)->where('user_id',auth()->user()->id)->delete();
                        // return $card;
                    }

                // invoice create:
                
                    $pdf = Pdf::loadView('invoice.orderinvoice', compact('order_details'));
                    $path = $order_details->id . "_" . "invoice.pdf";
                    $full_path = public_path('/storage/invoice/'.$path);
                    $pdf->save(public_path('/storage/invoice/'.$path));

                    $invoice = Invoice::create([
                        'order_id' => $order_details->id,
                        'inventory_path' => $full_path,
                        'path' => $path,
                    ]);

                    $request->session()->forget(['coupon','shipping_charge']);

                return redirect(route('frontend.home'))->with('success', 'Transaction Successfull');
            }
        } else if ($order_details->order_status == 'Processing' || $order_details->order_status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return "success";
            // return redirect(route('frontend.cart.show'))->with('success','Transaction Successfull');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return back()->with('error', 'Transaction Invalid');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = Order::where('transaction_id', $tran_id)->select('id','transaction_id', 'order_status', 'total', 'payment_status')->first();

        if ($order_details->order_status == 'Pending') {
            $update_product = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->update([
                'order_status' => 'Pending',
                'payment_status' => 'unpaid'
            ]);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
