@extends('layouts.frontapp')
@section('title', 'User - Dashboard')
@section('frontPageContent')
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index-2.html">Home</a></li>
                <li>My Account</li>
            </ul>
        </div>
    </div>

    <section class="account_section section_space">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.sidebar')

                <div class="col col-lg-9">
                    <div class="account_content_area">
                        <h3>My Order</h3>
                        <table class="table">
                            
                            <thead>
                                <th>Order Id #</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Created At</th>

                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    
                                        <tr>
                                            <td>#{{$order->id }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ $order->created_at->format('d-M-y') }}</td>

                                        </tr>
                                    
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
