 @extends('layouts.frontapp')
 @section('title', 'Product-cart')
 @section('frontPageContent')
     <!-- breadcrumb_section - start
                                                            ================================================== -->
     <div class="breadcrumb_section">
         <div class="container">
             <ul class="breadcrumb_nav ul_li">
                 <li><a href="{{ route('frontend.home') }}">Home</a></li>

                 <li>Cart</li>


             </ul>
         </div>
     </div>
     <!-- breadcrumb_section - end
                                                            ================================================== -->

     <!-- cart_section - start
                                                        ================================================== -->
     <section class="cart_section section_space">
         <div class="container">
             <div class="cart_update_wrap">
                 <p class="mb-0"><i class="fal fa-check-square"></i> Shipping costs updated.</p>
             </div>

             <div class="cart_table">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>Products</th>
                             <th class="text-center">Size && Color</th>
                             <th class="text-center">Price</th>
                             <th class="text-center">Quantity</th>
                             <th class="text-center">Total</th>
                             <th class="text-center">Stock</th>
                             <th class="text-center">Remove</th>
                         </tr>
                     </thead>
                     <tbody>


                         @foreach ($carts as $cart)
                             <tr class="card_main">
                                 <td>
                                     <div class="cart_product">
                                         @if (!empty($cart->inventory->product))
                                             <img src="{{ asset('storage/products/' . $cart->inventory->product->image) }}"
                                                 alt="image_not_found">
                                             <h3><a href="shop_details.html">{{ $cart->inventory->product->title }}</a></h3>
                                         @endif
                                     </div>
                                 </td>

                                 <td>
                                     {{ $cart->inventory->size->name }} -- {{ $cart->inventory->color->name }}
                                 </td>


                                 <td class="text-center">$
                                     <span class="product_price">
                                         @if (!empty($cart->inventory->product))
                                             @if ($cart->inventory->product->sale_price)
                                                 {{ $cart->inventory->product->sale_price + $cart->inventory->additional_price }}
                                             @endif
                                         @endif
                                     </span>
                                 </td>



                                 <td class="text-center">
                                     <form action="#">
                                         <div class="quantity_input">
                                             <input type="hidden" class="quantity_limit"
                                                 value="{{ $cart->inventory->quantity }}">

                                             <input type="hidden" value="{{ $cart->id }}" class="card_id">
                                             <button type="button" class="decrement_button">
                                                 <i class="fal fa-minus"></i>
                                             </button>
                                             <input class="input_number" type="text" value="{{ $cart->quantity }}" />
                                             <button type="button" class="increment_button">
                                                 <i class="fal fa-plus"></i>
                                             </button>
                                         </div>
                                     </form>
                                 </td>

                                 <td class="text-center">$
                                     <span class="price_text">
                                         {{ $cart->total_price }}
                                         {{-- @if (!empty($cart->inventory->product))
                                         @if ($cart->inventory->product->sale_price)
                                             {{ number_format(($cart->inventory->product->sale_price + $cart->inventory->additional_price) * $cart->quantity,2) }}
                                         @endif
                                        @endif --}}
                                     </span>
                                 </td>

                                 <td>{{ $cart->inventory->quantity }}</td>

                                 <td class="text-center">
                                     <form action="{{ route('frontend.cart.delete', $cart->id) }}" method="POST"
                                         class="delete_form">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="remove_btn"><i class="fal fa-trash-alt"></i>
                                         </button>
                                     </form>

                                 </td>
                             </tr>
                         @endforeach




                     </tbody>
                 </table>
             </div>

             <div class="cart_btns_wrap">
                 <div class="row">
                     <div class="col col-lg-6">
                         <form action="{{ route('frontend.couponApply.store') }}" method="POST">
                             @csrf
                             <div class="coupon_form form_item mb-0">
                                 <input type="text" name="coupon" placeholder="Coupon Code..."
                                     value="@if (Session::has('coupon')) {{ Session::get('coupon')['name'] }} @endif">
                                 <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                 <div class="info_icon">
                                     <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                         title="Your Info Here"></i>
                                 </div>
                             </div>
                         </form>
                     </div>

                     <div class="col col-lg-6">
                         <ul class="btns_group ul_li_right">
                             <li><a class="btn btn_dark" href="{{ route('frontend.cart.checkout') }}">Prceed To Checkout</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
             
             <div class="row">
                 <div class="col col-lg-6">
                     <div class="calculate_shipping">
                         <h3 class="wrap_title">Calculate Shipping <span class="icon"><i
                                     class="far fa-arrow-up"></i></span></h3>
                         <form action="#">
                             <div class="select_option clearfix">
                                 <select class="nice_select shipping_select">
                                     <option selected disabled>Select Your Option</option>
                                     @foreach ($shippings as $shipping)
                                         <option value="{{ $shipping->id }}">{{ $shipping->location }}</option>
                                     @endforeach


                                 </select>
                             </div>
                             <div class="row">
                                 <div class="col col-md-6">
                                     <div class="form_item">
                                         <input type="text" name="location" placeholder="State / Country">
                                     </div>
                                 </div>
                                 <div class="col col-md-6">
                                     <div class="form_item">
                                         <input type="text" name="postalcode" placeholder="Postcode / ZIP">
                                     </div>
                                 </div>
                             </div>
                             <button type="button" class="btn btn_primary rounded-pill">Update Total</button>
                         </form>
                     </div>
                 </div>

                 <div class="col col-lg-6">
                     <div class="cart_total_table">
                         <h3 class="wrap_title">Cart Totals</h3>
                         <ul class="ul_li_block">
                             <li>
                                 <span>Cart Subtotal</span>
                                 <span>$ <strong id="totalSum">{{ $carts->sum('total_price') }}</strong> </span>
                             </li>
                             <li>
                                 <span>Shipping and Handling</span>
                                 <span class="shipping_fee">Free Shipping</span>
                             </li>

                             <li>
                                 @if (Session::has('coupon'))
                                     <span>Coupon ({{ Session::get('coupon')['name'] }})</span>
                                     <span id="coupon_amount" class="coupon_price">
                                         {{ Session::get('coupon')['amount'] }}
                                     </span>
                                 @endif

                             </li>
                             <li>
                                 <span>Order Total</span>
                                 <span>$
                                     <strong class="order_total"> 
                                        @if (!(Session::has('coupon')))
                                        {{ $carts->sum('total_price') }}
                                        @endif
                                         @if (Session::has('coupon'))
                                             {{ $carts->sum('total_price') - Session::get('coupon')['amount'] }}
                                         @endif
                                    </strong>
                                 </span>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- cart_section - end
      ================================================== -->
 @endsection


 @section('footer-js')
     

     <script>
         $(document).ready(function() {

             $increment = $('.increment_button')
             $decriment = $('.decrement_button')

             $increment.on('click', function() {
                 $price = $(this).parents('.card_main').find('.product_price').html();
                 $total_price = $(this).parents('.card_main').find('.price_text');
                 $cart_id = $input = $(this).parent('.quantity_input').children('.card_id').val();
                 $input = $(this).parent('.quantity_input').children('.input_number');
                 $quantity_limit = $(this).parent('.quantity_input').children('.quantity_limit')
                 $quantity_limit_value = $quantity_limit.val()
                 $inc = $input.val();
                 if (parseInt($quantity_limit_value) > $inc) {
                     $inc++;
                     $input.val($inc)
                 }
                 $total_price.html(parseFloat($inc * $price).toFixed(2));
                //  $coupon_amount = $('#coupon_amount')

                 $.ajax({
                     type: 'POST',
                     url: '{{ route('frontend.cart.update') }}',
                     dataType: 'json',
                     data: {
                         cart_id: $cart_id,
                         total: parseFloat($price) * $inc,
                         quantity: $inc,
                         _token: "{{ csrf_token() }}",
                     },
                     success: function(data) {
                        $('#totalSum').html(data.total)
                        // $('.order_total').html(data.grand_total)     
                        if($('.shipping_fee').html() === "Free Shipping"){
                            $('.order_total').html(data.grand_total)     
                        } else{
                            $('.order_total').html(data.grand_total + parseFloat($('.shipping_fee').html()))
                        }                   
                              
                     }
                 })


             })

             $decriment.on('click', function() {
                 $decriment_box = $(this).parent('.quantity_input').children('.input_number');
                 $price = $(this).parents('.card_main').find('.product_price').html();
                 $total_price = $(this).parents('.card_main').find('.price_text');
                 $cart_id = $input = $(this).parent('.quantity_input').children('.card_id').val();
                 $dec = $decriment_box.val()
                 if ($dec > 1) {
                     $dec--;
                     $decriment_box.val($dec)
                 }

                 $total_price.html(parseFloat($dec * $price).toFixed(2));
                //  $coupon_amount = $('#coupon_amount')

                 $.ajax({
                     type: 'POST',
                     url: '{{ route('frontend.cart.update') }}',
                     dataType: 'json',
                     data: {
                         cart_id: $cart_id,
                         total: parseFloat($price) * $dec,
                         quantity: $dec,
                         _token: "{{ csrf_token() }}",
                     },
                     success: function(data) {
                        $('#totalSum').html(data.total)
                        // $('.order_total').html(data.grand_total + parseFloat($('.shipping_fee').html())) 
                        if($('.shipping_fee').html() === "Free Shipping"){
                            $('.order_total').html(data.grand_total)     
                        } else{
                            $('.order_total').html(data.grand_total + parseFloat($('.shipping_fee').html()))
                        }            
                     }
                 })

             })


             //  delete btn:
             //  $delete_btn = $(this).parent('form').children('.remove_btn');
             //  $delete_btn = $('.delete_form .remove_btn')
             $('.delete_form .remove_btn').on('click', function() {
                 if (confirm("Are you sure ???") == true) {
                     $('.delete_form').submit()
                     console.log($delete_btn.type)
                 }
             })

             // shipping select ajax:

             $('.shipping_select').on('change', function() {
                 $shipping_id = $('.shipping_select').val();
                 $total_price = $('.order_total').html();
                 $.ajax({
                     type: 'POST',
                     url: '{{ route('dashboard.shipping.shippingApply') }}', // ShippingController 
                     dataType: 'json',
                     data: {
                          
                         total_price : $total_price,
                         shipping_id: $shipping_id,
                         _token: "{{ csrf_token() }}",
                     },
                     success: function(data) {
                        $('.shipping_fee').html("+" + parseFloat(data.shipping_amount));
                        $('.order_total').html(data.order_total);
                         console.log(data)
                     }
                 })
             })

         })
     </script>
 @endsection
