

@extends('layouts.backendapp')
@section('title','Orders')
@section('backendContent')
    <div class="row mt-5">
        <div class="col-lg-12">
             <a href="{{ route('dashboard.order.index') }}"><button class="btn btn-info">Refresh</button></a>
        </div>
    </div>
     <div class="card mt-4">
        <div class="card-header">
             <form action="{{ route('dashboard.order.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-lg-2">
                        <input type="search" class="form-control" placeholder="order id" name="order_id" value="{{ request()->order_id }}">
                    </div>

                    <div class="col-lg-2">
                        <select class="form-control" name="order_status">
                            <option selected disabled>Select Order Status</option>
                            <option value="Pending" {{ request()->order_status == 'Pending' ? 'selected' : '' }} >Pending</option>
                            <option value="Processing" {{ request()->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Cancel"{{ request()->order_status == 'Cancel' ? 'selected' : '' }} >Cancel</option>
                        </select>
                          
                    </div>

                    <div class="col-lg-2">
                        <select class="form-control" name="payment_status">
                            <option selected disabled>Select Payment Status</option>
                            <option value="Paid" {{ request()->payment_status == 'Paid' ? 'selected' : '' }} >Paid</option>
                            <option value="Unpaid" {{ request()->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Start Date</label>
                        <input type="date" class="form-control" value="{{ request()->start_date }}" placeholder="order id" name="start_date">
                    </div>

                    <div class="col-lg-2">
                        <label for="">End Date</label>
                        <input type="date" class="form-control" placeholder="order id" name="end_date" value="{{ request()->end_date }}">
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
                                    <a href="{{route('dashboard.order.show',$order->id)}}" class="btn  btn-success">View</a>
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