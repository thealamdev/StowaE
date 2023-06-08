@extends('layouts.backendapp')
@section('title', 'Order-Details')
@section('backendContent')


    <div class="flex-row-fluid ml-lg-8 mt-3">
    
        <div class="card card-custom gutter-b">
            <div class="card-body p-0">
                
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-5 font-weight-boldest mb-10">ORDER DETAILS</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-5">
                                    <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.istockphoto.com%2Fillustrations%2Fleadership-logo&psig=AOvVaw17s1-JCo7rx5OXObHyfpaG&ust=1686324866701000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCJig1-n_s_8CFQAAAAAdAAAAABAE" alt="" width="50px">
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <span>{{ auth()->user()->user_info->address }}</span>
                                    <span>{{ auth()->user()->user_info->city . ','. auth()->user()->user_info->zip }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex justify-content-between pt-6">
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
                                <span>{{ auth()->user()->name }}</span>
                                <span>{{ auth()->user()->user_info->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                 
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
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
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
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
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-10">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                onclick="window.print();">Download Order Details</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print
                                Order Details</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection
