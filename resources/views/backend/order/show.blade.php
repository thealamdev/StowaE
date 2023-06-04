@extends('layouts.backendapp')
@section('title','Order-Details')
@section('backendContent')
     <div class="card mt-3">
          <div class="card-header">
                {{-- Product : {{ $order->inventory_order->product->title }} --}}
                Transaction Id: {{ $order->transaction_id }}
          </div>

          <div class="card-body">
               <div class="row">
                    <div class="col-lg-6">
                         <table class="table">
                              <thead>
                                   <th>Product Image</th>
                                   <th>Product Title</th>
                                   <th>Product Quantity</th>
                                   <th>Product Price</th>
                              </thead>
                              <tbody>
                                   @foreach ($order->inventory_order as $products)
                                   <tr>
                                        <td><img src="{{ asset('storage/products/'.$products->product->image) }}" alt="" width="50px"></td>
                                        <td>{{ $products->product->image }}</td>
                                        <td>{{ $order->inventory_order->quantity }}</td>
                                   </tr>
                                   @endforeach
                              </tbody>
                               
                               
                         </table>
                    </div>
               </div>
                
          </div>

          <div class="card-footer">

          </div>
     </div>
@endsection