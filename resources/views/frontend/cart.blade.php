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
                             <th>Product</th>
                             <th class="text-center">Price</th>
                             <th class="text-center">Size && Color</th>
                             <th class="text-center">Quantity</th>
                             <th class="text-center">Total</th>
                             <th class="text-center">Stock</th>
                             <th class="text-center">Remove</th>
                         </tr>
                     </thead>
                     <tbody>


                         @foreach ($carts as $cart)
                             <tr>
                                 <td>
                                     <div class="cart_product">
                                         <img src="{{ asset('storage/products/' . $cart->inventory->product->image) }}"
                                             alt="image_not_found">
                                         <h3><a href="shop_details.html">{{ $cart->inventory->product->title }}</a></h3>
                                     </div>
                                 </td>

                                 <td>
                                     {{ $cart->inventory->size->name }} -- {{ $cart->inventory->color->name }}
                                 </td>


                                 <td class="text-center">$
                                     <span class="product_price">
                                         @if ($cart->inventory->product->sale_price)
                                             {{ $cart->inventory->product->sale_price + $cart->inventory->additional_price }}
                                         @endif
                                     </span>
                                 </td>


                                 <td class="text-center">
                                     <form action="#">
                                         <div class="quantity_input">
                                             <input type="hidden" class="quantity_limit"
                                                 value="{{ $cart->inventory->quantity }}">
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

                                 <td class="text-center">
                                     <span class="price_text">
                                         @if ($cart->inventory->product->sale_price)
                                             {{ ($cart->inventory->product->sale_price + $cart->inventory->additional_price) * $cart->quantity }}
                                         @endif
                                     </span>
                                 </td>

                                 <td>{{ $cart->inventory->quantity }}</td>

                                 <td class="text-center">
                                     <form action="{{ route('frontend.cart.delete', $cart->id) }}" method="POST"
                                         class="delete_form">
                                         @csrf
                                         @method('DELETE')
                                         <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i>
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
                         <form action="#">
                             <div class="coupon_form form_item mb-0">
                                 <input type="text" name="coupon" placeholder="Coupon Code...">
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
                             <li><a class="btn border_black" href="#!">Update Cart</a></li>
                             <li><a class="btn btn_dark" href="#!">Prceed To Checkout</a></li>
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
                                 <select>
                                     <option data-display="Select Your Currency">Select Your Option</option>
                                     <option value="1" selected>United Kingdom (UK)</option>
                                     <option value="2">United Kingdom (UK)</option>
                                     <option value="3">United Kingdom (UK)</option>
                                     <option value="4">United Kingdom (UK)</option>
                                     <option value="5">United Kingdom (UK)</option>
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
                             <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
                         </form>
                     </div>
                 </div>

                 <div class="col col-lg-6">
                     <div class="cart_total_table">
                         <h3 class="wrap_title">Cart Totals</h3>
                         <ul class="ul_li_block">
                             <li>
                                 <span>Cart Subtotal</span>
                                 <span>$52.50</span>
                             </li>
                             <li>
                                 <span>Shipping and Handling</span>
                                 <span>Free Shipping</span>
                             </li>
                             <li>
                                 <span>Order Total</span>
                                 <span class="total_price">$52.50</span>
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
     @if (Session::has('success'))
         <script>
            Command: toastr["success"]("{!! Session::get('success') !!}", "success")
             toastr.options = {
                 "closeButton": true,
                 "debug": false,
                 "newestOnTop": false,
                 "progressBar": true,
                 "positionClass": "toast-top-right",
                 "preventDuplicates": false,
                 "onclick": null,
                 "showDuration": "300",
                 "hideDuration": "1000",
                 "timeOut": "5000",
                 "extendedTimeOut": "1000",
                 "showEasing": "swing",
                 "hideEasing": "linear",
                 "showMethod": "fadeIn",
                 "hideMethod": "fadeOut"
             }
         </script>
     @endif

     <script>
         $(document).ready(function() {

             $increment = $('.increment_button')
             $decriment = $('.decrement_button')

             $increment.on('click', function() {
                 $input = $(this).parent('.quantity_input').children('.input_number');
                 $quantity_limit = $(this).parent('.quantity_input').children('.quantity_limit')
                 $quantity_limit_value = $quantity_limit.val()
                 $inc = $input.val();
                 if (parseInt($quantity_limit_value) > $inc) {
                     $inc++;
                     $input.val($inc)
                 }

             })

             $decriment.on('click', function() {
                 $decriment_box = $(this).parent('.quantity_input').children('.input_number');
                 $dec = $decriment_box.val()
                 if ($dec > 1) {
                     $dec--;
                     $decriment_box.val($dec)
                 }

             })


             //  delete btn:
             $delete_btn = $('.delete_form .remove_btn')
             $delete_btn.on('click', function() {
                 if (confirm("Are you sure ???") == true) {
                     $('.delete_form').submit()
                     console.log($delete_btn.type)
                 }
             })


         })
     </script>
 @endsection
