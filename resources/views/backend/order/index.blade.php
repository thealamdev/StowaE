

@extends('layouts.backendapp')
@section('title','Orders')
@section('backendContent')
     <div class="card mt-4">
        <div class="card-header">
             <form action="{{ route('dashboard.order.index') }}" method="GET">
                <div class="row">
                    <div class="col-lg-2">
                        <input type="search" class="form-control" placeholder="order id" name="order_id" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <input type="text" class="form-control" placeholder="order id" name="order_status" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <input type="text" class="form-control" placeholder="order id" name="payment_status" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <input type="date" class="form-control" placeholder="order id" name="start_date" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <input type="date" class="form-control" placeholder="order id" name="end_date" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <button class="btn btn-info form-control" type="submit" value="search">Search</button>
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