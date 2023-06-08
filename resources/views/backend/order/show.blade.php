@extends('layouts.backendapp')
@section('title', 'Order-Details')
@section('backendContent')


    <div class="flex-row-fluid ml-lg-8 mt-3">
    
        <div class="card card-custom">
            <div class="card-body">
                
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0 mt-3">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-6 font-weight-boldest mb-10">ORDER DETAILS</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-3">
                                    <img src="https://img.freepik.com/free-vector/colorful-company-logo-template-with-tagline_23-2148802643.jpg" alt="dd" width="50px">
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <span>{{  $order_details->shipping_address->address ?? $order_details->user->user_info->address }}</span>
                                    <span>{{  $order_details->shipping_address->phone ?? $order_details->user->user_info->phone }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100 pt-4"></div>
                        <div class="d-flex justify-content-between pt-4">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">ORDER DATE</span>
                                <span class="opacity-70">{{ $order_details->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">ORDER NO.</span>
                                <span class="opacity-70">#{{ $order_details->id }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">DELIVERED TO.</span>
                                <span>{{  $order_details->shipping_address->name ?? $order_details->user->name }}</span>
                                <span>{{  $order_details->shipping_address->phone ?? $order_details->user->user_info->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0 mt-4 mt-4">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">Shipping City</th>
                                        <th class="font-weight-bold text-muted text-uppercase">District</th>
                                        <th class="font-weight-bold text-muted text-uppercase">Phone</th>
                                        <th class="font-weight-bold text-muted text-uppercase text-right">Zip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{ $order_details->shipping_address->address ?? $order_details->user->user_info->address }}</td>
                                        <td>{{ $order_details->shipping_address->city ?? $order_details->user->user_info->city }}</td>
                                        <td>{{ $order_details->shipping_address->phone ?? $order_details->user->user_info->phone }}</td>
                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ $order_details->shipping_address->zip ?? $order_details->user->user_info->zip }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 mt-4">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Items Color</th>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Items Size</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventory_orders as $inventory_order)
                                    @php
                                        $unit_price = $inventory_order->amount + $inventory_order->additional_price ?? 0;
                                        $total_price = $inventory_order->amount + $inventory_order->additional_price ?? 0 * $inventory_order->quantity;

                                    @endphp
                                    
                                    <tr class="font-weight-boldest">
                                        <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                             
                                            <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                              <img src="{{ asset('storage/products/'.$inventory_order->image) }}" alt="" width="40px" style="border-radius: 10px;">
                                              {{ $inventory_order->title }}
                                            </div>
                                            
                                             
                                        </td>
                                        <td class="text-left pt-7 align-middle">{{ $inventory_order->color_name }}</td>
                                        <td class="text-left pt-7 align-middle">{{ $inventory_order->size_name }}</td>
                                        <td class="text-right pt-7 align-middle">{{ $inventory_order->quantity }}</td>
                                        <td class="text-right pt-7 align-middle">{{ $unit_price }}</td>
                                        <td class="text-primary pr-0 pt-7 text-right align-middle"> {{ $total_price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0 mt-4">
                    <div class="col-md-10">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT TYPE</th>
                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                        <th class="font-weight-bold text-muted text-uppercase">PAYMENT DATE</th>
                                        <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>Credit Card</td>
                                        <td>{{ $order_details->payment_status }}</td>
                                        <td>{{ $order_details->created_at->format('Y-m-d') }}</td>
                                        <td class="text-primary font-size-h3 font-weight-boldest text-right">{{ $order_details->total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                onclick="window.print();">Download Order Details</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print
                                Order Details</button>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        
    </div>
@endsection
