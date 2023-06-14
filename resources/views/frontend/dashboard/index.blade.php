@extends('layouts.frontapp')
@section('title','User - Dashboard')
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
                    <h3>My Dashboard</h3>
                    <ul class="content_layout ul_li_block">
                        <li>
                            <h4><strong>Hello, Elena Velykorodnova!</strong></h4>
                            <p class="mb-0">From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                        </li>
                        <li>
                            <h4>Contact Information</h4>
                            <p class="mb-0">John Doe</p>
                            <a class="mb-3" href="#!">info@example.com</a>
                            <ul class="btns_group ul_li">
                                <li><a class="btn" href="#!">Edit Account Information</a></li>
                                <li><a class="btn" href="#!">Change Password</a></li>
                            </ul>
                        </li>
                        <li>
                            <h4>Newsletter</h4>
                            <p>You are currently not subscribed to any newsletter. </p>
                            <a class="btn" href="#!">Edit Subscription</a>
                        </li>
                        <li>
                            <h4 class="mb-3">Address Book</h4>
                            <a class="btn" href="#!">Manage Addresses</a>
                        </li>
                        <li>
                            <h4>Default Billing Address</h4>
                            <p>You have not set a default billing address.</p>
                            <a class="btn" href="#!">Edit Address</a>
                        </li>
                        <li>
                            <h4>Default Shipping Address</h4>
                            <p>You have not set a default shipping address.</p>
                            <a class="btn" href="#!">Edit Address</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

 