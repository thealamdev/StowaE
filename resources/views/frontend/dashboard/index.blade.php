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
                        <h3>My Dashboard</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
