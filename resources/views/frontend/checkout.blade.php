@extends('layouts.frontapp')
@section('title', 'Checkout')
@section('frontPageContent')
    <!-- breadcrumb_section - start
                    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index-2.html">Home</a></li>
                <li>Check Out</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
                    ================================================== -->


    <!-- checkout-section - start
                    ================================================== -->
    <section class="checkout-section section_space">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="woocommerce">
                        <div class="woocommerce-info">Returning customer? <a href="#" class="showlogin">Click here to
                                login</a></div>
                        <form method="post" class="login">
                            <p>If you have shopped with us before, please enter your details in the boxes below. If you are
                                a new customer, please proceed to the Billing &amp; Shipping section.</p>
                            <p class="form-row form-row-first">
                                <label for="username">Username or email <span class="required">*</span></label>
                                <input type="text" class="input-text" name="username" id="username" />
                            </p>
                            <p class="form-row form-row-last">
                                <label for="password">Password <span class="required">*</span></label>
                                <input class="input-text" type="password" name="password" id="password" />
                            </p>
                            <div class="clear"></div>
                            <p class="form-row">
                                <input type="hidden" id="_wpnonce" name="_wpnonce" value="94dfaf2ac1" />
                                <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" />
                                <input type="submit" class="button" name="login" value="Login" />
                                <input type="hidden" name="redirect" value="http://localhost/wp/?page_id=6" />
                                <label for="rememberme" class="inline">
                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember me
                                </label>
                            </p>
                            <p class="lost_password">
                                <a href="http://localhost/wp/?page_id=7&amp;lost-password">Lost your password?</a>
                            </p>
                            <div class="clear"></div>
                        </form>
                        <div class="woocommerce-info">Have a coupon? <a href="#" class="showcoupon">Click here to
                                enter your code</a></div>
                        <form class="checkout_coupon" method="post">
                            <p class="form-row form-row-first">
                                <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code"
                                    id="coupon_code" value="" />
                            </p>
                            <p class="form-row form-row-last">
                                <input type="submit" class="button" name="apply_coupon" value="Apply Coupon" />
                            </p>
                            <div class="clear"></div>
                        </form>
                        <form name="checkout" method="post" class="checkout woocommerce-checkout"
                            action="http://localhost/wp/?page_id=6" enctype="multipart/form-data">
                            <div class="col2-set" id="customer_details">
                                <div class="coll-1">
                                    <div class="woocommerce-billing-fields">
                                        <h3>Billing Details</h3>
                                        <p class="form-row form-row form-row-first validate-required"
                                            id="billing_last_name_field">
                                            <label for="billing_last_name" class=""> Name <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="name"
                                                 placeholder="Enter Name" 
                                                value="{{ auth()->user()->name }}" />
                                        </p>
                                        
                                        <p class="form-row form-row form-row-last validate-required"
                                            id="billing_last_name_field">
                                            <label for="billing_last_name" class="">Email address <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="email"
                                                 placeholder="Enter email" 
                                                value="{{ auth()->user()->email }}" />
                                        </p>
                                        <div class="clear"></div>
                                         
                                        <p class="form-row form-row form-row-first validate-required validate-email"
                                            id="billing_email_field">
                                            <label for="billing_email" class="">Phone Number<abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="tel" class="input-text " name="phone"
                                                  placeholder="Enter phone number" value="" />
                                        </p>

                                        <p class="form-row form-row form-row-last validate-required validate-phone"
                                            id="billing_phone_field">
                                            <label for="billing_phone" class="">Address <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="address"
                                                 placeholder="Enter address"  value="" />
                                        </p>
                                        <div class="clear"></div>
                                        
                                         
                                        <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                            id="billing_city_field">
                                            <label for="billing_city" class="">Town / City <abbr class="required"
                                                    title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="city"
                                                id="billing_city" placeholder="Ente city name" autocomplete="address-level2"
                                                value="" />
                                        </p>
                                        <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                            id="billing_postcode_field">
                                            <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                    class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="zip"
                                                id="billing_postcode" placeholder="Enter zip code"  
                                                value="" />
                                        </p>
                                        <div class="clear"></div>
                                         
                                         
                                    </div>
                                </div>
                                <div class="coll-2">
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label for="ship-to-different-address-checkbox" class="checkbox">Ship to a
                                                different address?</label>
                                            <input id="ship-to-different-address-checkbox" class="input-checkbox"
                                                type="checkbox" name="ship_to_different_address" value="1" />
                                        </h3>
                                        <div class="shipping_address">
                                            <p class="form-row form-row form-row-first validate-required"
                                                id="shipping_first_name_field">
                                                <label for="shipping_first_name" class="">First Name <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_first_name"
                                                    id="shipping_first_name" placeholder="" autocomplete="given-name"
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-last validate-required"
                                                id="shipping_last_name_field">
                                                <label for="shipping_last_name" class="">Last Name <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_last_name"
                                                    id="shipping_last_name" placeholder="" autocomplete="family-name"
                                                    value="" />
                                            </p>
                                            <div class="clear"></div>
                                            <p class="form-row form-row form-row-wide" id="shipping_company_field">
                                                <label for="shipping_company" class="">Company Name</label>
                                                <input type="text" class="input-text " name="shipping_company"
                                                    id="shipping_company" placeholder="" autocomplete="organization"
                                                    value="" />
                                            </p>
                                         
                                            <p class="form-row form-row form-row-wide address-field validate-required"
                                                id="shipping_address_1_field">
                                                <label for="shipping_address_1" class="">Address <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="shipping_address_1"
                                                    id="shipping_address_1" placeholder="Street address"
                                                    autocomplete="address-line1" value="" />
                                            </p>
                                            <p class="form-row form-row form-row-wide address-field"
                                                id="shipping_address_2_field">
                                                <input type="text" class="input-text " name="shipping_address_2"
                                                    id="shipping_address_2"
                                                    placeholder="Apartment, suite, unit etc. (optional)"
                                                    autocomplete="address-line2" value="" />
                                            </p>
                                            <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                                id="billing_city_field2">
                                                <label for="billing_city" class="">Town / City <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_city"
                                                    id="billing_city3" placeholder="" autocomplete="address-level2"
                                                    value="" />
                                            </p>
                                            <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                                id="billing_postcode_field17">
                                                <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_postcode"
                                                    id="billing_postcode4" placeholder="" autocomplete="postal-code"
                                                    value="" />
                                            </p>
                                            <div class="clear"></div>
                                        </div>
                                        <p class="form-row form-row notes" id="order_comments_field">
                                            <label for="order_comments" class="">Order Notes</label>
                                            <textarea name="order_comments" class="input-text " id="order_comments"
                                                placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <h3 id="order_review_heading">Your order</h3>
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    {{ $cart->inventory->product->title }}&nbsp; <strong
                                                        class="product-quantity">&times;
                                                        {{ $cart->quantity }}</strong>
                                                </td>
                                                <td class="product-total">
                                                    <span class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">$</span>{{ $cart->total_price }}</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol">$</span>{{ $carts->sum('total_price') }}</span>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Coupon</th>
                                            <td data-title="Shipping">
                                                @if (Session::has('coupon'))
                                                    -$ {{ Session::get('coupon')['amount'] }}
                                                @endif

                                                <input type="hidden" name="shipping_method[0]" data-index="0"
                                                    id="shipping_method_0" value="free_shipping:1"
                                                    class="shipping_method" />
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td data-title="Shipping">
                                                @if (Session::has('shipping_amount'))
                                                   +$ {{ Session::get('shipping_amount') }}
                                                @endif
                                                <input type="hidden" name="shipping_method[0]" data-index="0"
                                                    id="shipping_method_0" value="free_shipping:1"
                                                    class="shipping_method" />
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">$</span>{{ $carts->sum('total_price') - Session::get('coupon')['amount'] + Session::get('shipping_amount')}}</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div id="payment" class="woocommerce-checkout-payment">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_cheque">
                                            <input id="payment_method_cheque" type="radio" class="input-radio"
                                                name="payment_method" value="cheque" checked='checked'
                                                data-order_button_text="" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_cheque">
                                                Check Payments </label>
                                            <div class="payment_box payment_method_cheque">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State
                                                    / County, Store Postcode.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal">
                                            <input id="payment_method_paypal" type="radio" class="input-radio"
                                                name="payment_method" value="paypal"
                                                data-order_button_text="Proceed to PayPal" />
                                            <!--grop add span for radio button style-->
                                            <span class='grop-woo-radio-style'></span>
                                            <!--custom change-->
                                            <label for="payment_method_paypal">
                                                PayPal <img src="assets/images/paypal.png"
                                                    alt="PayPal Acceptance Mark" /><a href="#" class="about_paypal"
                                                    title="What is PayPal?">What is PayPal?</a> </label>
                                            <div class="payment_box payment_method_paypal" style="display:none;">
                                                <p>Pay via PayPal; you can pay with your credit card if you don&#8217;t have
                                                    a PayPal account.</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">
                                        <noscript>
                                            Since your browser does not support JavaScript, or it is disabled, please ensure
                                            you click the <em>Update Totals</em> button before placing your order. You may
                                            be charged more than the amount stated above if you fail to do so.
                                            <br />
                                            <input type="submit" class="button alt"
                                                name="woocommerce_checkout_update_totals" value="Update totals" />
                                        </noscript>
                                        <input type="submit" class="button alt" name="woocommerce_checkout_place_order"
                                            id="place_order" value="Place order" data-value="Place order" />
                                        <input type="hidden" id="_wpnonce5" name="_wpnonce" value="783c1934b0" />
                                        <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout-section - end
                    ================================================== -->

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/woocommerce-2.css') }}">
@endsection
