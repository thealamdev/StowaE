

@extends('layouts.backendapp')
@section('title','Orders')
@section('backendContent')
     <div class="card mt-4">
        <div class="card-header">
             <form action="{{ route('dashboard.order.index') }}" method="GET">
                <div class="row">
                    <div class="col-lg-2">
                        <input type="search" class="form-control" placeholder="order id" name="order_id" value="{{ request()->order_id }}">

                        <button class="btn btn-info" type="submit" value="search"></button>
                    </div>
                </div>
             </form>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <th>Order Id #</th>
                            <th>User Name</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                         
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->created_at->format('d-M-y') }}</td>
                                <td>
                                    <a href="#" class="btn  btn-success">View</a>
                                </td>
                            </tr>
                            @endforeach
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{ $orders->links() }}
        </div>
     </div>
@endsection