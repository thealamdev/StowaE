@extends('layouts.frontapp')
@section('title')
{{ $products->title }}
@endsection
{{-- @section('title', 'Product-show') --}}
@section('frontPageContent')
    <div class="container">
        <div class="row mt-4">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">

                        @foreach ($products->product_gallaries as $gallary)
                            <div class="slider_item">
                                <img src="{{ asset('storage/gallary/' . $gallary->image) }}" alt="image_not_found">
                            </div>
                        @endforeach


                    </div>

                    <div class="details_image_carousel_nav">
                        @foreach ($products->product_gallaries as $gallary)
                            <div class="slider_item">
                                <img src="{{ asset('storage/gallary/' . $gallary->image) }}" alt="image_not_found">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="product_details_content">
                    <h2 class="item_title">{{ $products->title }}</h2>
                    <p>{{ $products->short_description }}</p>
                    <div class="item_review">
                        <ul class="rating_star ul_li">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <span class="review_value">3 Rating(s)</span>
                    </div>

                    <div class="item_price">
                        <p> $ <span class="product_price"> {{ $products->sale_price ?? $products->price }}</span> </p>
                        <del>
                            @if ($products->discount)
                                ${{ $products->price }}
                            @endif
                        </del>
                    </div>
                    <hr>

                    <div id="form_all">
                         
                            <div class="item_attribute">
                                <h3 class="title_text">Options <span class="underline"></span></h3>



                                <div class="row">

                                    <div class="col col-md-6">
                                        <div class="select_option clearfix">
                                            <h4 class="input_title">Color *</h4>
                                            <select id="ColorSelect" class="form-control" name="color_id">
                                                <option disabled selected>Choose A Option</option>
                                                @forelse ($inventory_color as $key => $inv_color)
                                                    <option value="{{ $inv_color->id }}">{{ $inv_color->name }}</option>
                                                @empty
                                                    {{ 'No color found' }}
                                                @endforelse
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col col-md-6">

                                        <div class="select_option clearfix">
                                            <h4 class="input_title">Size *</h4>
                                            <select class="form-control" id="sizeSelect" name="size_id">
                                                <option selected disabled>Select a Product size</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <span class="repuired_text">Stock Quantity: <span class="quantity_limit"></span>


                            </div>

                        <form action="{{ route('frontend.cart.store') }}" id="shopForm" method="POST">
                            @csrf
                            <input type="hidden" name="inventory_id" id="inventory_id">
                            <input type="hidden" name="total_price" id="total_amount">

                            <div class="quantity_wrap">

                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>

                                    <input type="text" class="quantity" name="quantity" value="1">

                                    <button type="button" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>


                                <div class="total_price">
                                    Total Price : $
                                    <span id="totalPrice">
                                        {{ $products->discount ? $products->sale_price : $products->price }}
                                    </span>
                                    <div class="additional_price_box">
                                        <p style="color:#333;font-size:14px;">Additional Price: <span> </span> </p> 
                                    </div>
                                </div>
                            </div>

                            <ul class="default_btns_group ul_li">
                                <li><button type="submit" class="btn btn_primary addtocart_btn">Add To Cart</button></li>

                                <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                            </ul>
                        </form>

                            <ul class="default_share_links ul_li">
                                <li>
                                    <a class="facebook" href="#!">
                                        <span><i class="fab fa-facebook-square"></i> Like</span>
                                        <small>10K</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter" href="#!">
                                        <span><i class="fab fa-twitter-square"></i> Tweet</span>
                                        <small>15K</small>
                                    </a>
                                </li>

                                <li>
                                    <a class="google" href="#!">
                                        <span><i class="fab fa-google-plus-square"></i> Google+</span>
                                        <small>20K</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="share" href="#!">
                                        <span><i class="fas fa-plus-square"></i> Share</span>
                                    </a>
                                </li>
                            </ul>
                         
                    </div>

                </div>
            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role="tablist">
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button"
                        role="tab" aria-controls="description_tab" aria-selected="true">
                        Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab"
                        aria-controls="additional_information_tab" aria-selected="false">
                        Additional information
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab"
                        aria-controls="reviews_tab" aria-selected="false">
                        Reviews(2)
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    <p>{{ $products->description }}</p>
                    <p class="mb-0">
                        Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros
                        eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis
                        vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit
                        amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere
                        nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam
                        gravida vehicula tellus, in imperdiet ligula euismod eget.
                    </p>
                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                    <p>
                        {{ $products->additional_info }}
                    </p>

                    <div class="additional_info_list">
                        <h4 class="info_title">Additional Info</h4>
                        <ul class="ul_li_block">
                            <li>No Side Effects</li>
                            <li>Made in USA</li>
                        </ul>
                    </div>

                    <div class="additional_info_list">
                        <h4 class="info_title">Product Features Info</h4>
                        <ul class="ul_li_block">
                            <li>Compatible for indoor and outdoor use</li>
                            <li>Wide polypropylene shell seat for unrivalled comfort</li>
                            <li>Rust-resistant frame</li>
                            <li>Durable UV and weather-resistant construction</li>
                            <li>Shell seat features water draining recess</li>
                            <li>Shell and base are stackable for transport</li>
                            <li>Choice of monochrome finishes and colourways</li>
                            <li>Designed by Nagi</li>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <h4 class="reviews_tab_title">Average Ratings</h4>
                        <div class="row align-items-center">
                            <div class="col-md-5 order-last">
                                <div class="average_rating_text">
                                    <ul class="rating_star ul_li_center">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <p class="mb-0">
                                        Average Star Rating: <span>4.3 out of 5</span> (2 vote)
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="product_ratings_progressbar">
                                    <ul class="five_star ul_li">
                                        <li><span>5 Star</span></li>
                                        <li>
                                            <div class="progress_bar"></div>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                    <ul class="four_star ul_li">
                                        <li><span>4 Star</span></li>
                                        <li>
                                            <div class="progress_bar"></div>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </li>
                                    </ul>
                                    <ul class="three_star ul_li">
                                        <li><span>3 Star</span></li>
                                        <li>
                                            <div class="progress_bar"></div>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </li>
                                    </ul>
                                    <ul class="two_star ul_li">
                                        <li><span>2 Star</span></li>
                                        <li>
                                            <div class="progress_bar"></div>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </li>
                                    </ul>
                                    <ul class="one_star ul_li">
                                        <li><span>1 Star</span></li>
                                        <li>
                                            <div class="progress_bar"></div>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                            <i class="fal fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">2 reviews for this product</h4>
                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="assets/images/team/team_1.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Aonathor troet</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                            </div>
                        </div>

                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="assets/images/team/team_2.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Danial obrain</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">
                                    Great product quality, Great Design and Great Service.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="customer_review_form">
                        <h4 class="reviews_tab_title">Add a review</h4>
                        <p>
                            Your email address will not be published. Required fields are marked *
                        </p>
                        <form action="#">
                            <div class="form_item">
                                <input type="text" name="name" placeholder="Your name*">
                            </div>
                            <div class="form_item">
                                <input type="email" name="email" placeholder="Your Email*">
                            </div>
                            <div class="checkbox_item">
                                <input id="save_checkbox" type="checkbox">
                                <label for="save_checkbox">Save my name, email, and website in this browser for the next
                                    time I comment.</label>
                            </div>
                            <div class="your_ratings">
                                <h5>Your Ratings:</h5>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                            </div>
                            <div class="form_item">
                                <textarea name="comment" placeholder="Your Review*"></textarea>
                            </div>
                            <button type="submit" class="btn btn_primary">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-js')
    <script>
        // ajax shop size select:
        $(document).ready(function() {
            // all variable:
            $totalPrice = $('#totalPrice');
            $incriment = $('.input_number_increment')
            $decriment = $('.input_number_decrement')
            $quantity = $('.quantity')
            $product_price = $('.product_price')
            $quantity_limit = $('.quantity_limit')
            $additional_price = $('.additional_price_box span').val();
            $update_value = $quantity.val()


            $('#ColorSelect').on('change', function() {

                $id = {{ $products->id }}
                $color_id = $('#ColorSelect').val()
                $.ajax({
                    type: 'POST',
                    url: "{{ route('frontend.shop.sizeSelect') }}",
                    dataType: 'json',
                    data: {
                        id: $id,
                        color_id: $color_id,
                        _token: '{{ csrf_token() }}',
                    },

                    success: function(data) {
                        console.log(data)
                        $('#sizeSelect').html(data)

                    }
                })

                $quantity.val(1)


            })


            // total Price section:
            $('#sizeSelect').on('change', function() {
                $size_id = $('#sizeSelect').val()
                $product_id = {{ $products->id }}
                $color_id = $('#ColorSelect').val()
                $.ajax({
                    type: 'POST',
                    url: '{{ route('frontend.shop.additionalPrice') }}',
                    dataType: 'json',
                    data: {
                        product_id: $product_id,
                        color_id: $color_id,
                        size_id: $size_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#inventory_id').val(data.inventory_id)
                        $('.product_price').html(parseFloat(data.price).toFixed(2))
                        $('.quantity_limit').html(data.quantity);
                        $('.additional_price_box span').html(data.additional_price)
                        $('#totalPrice').html(parseFloat(data.price).toFixed(2))
                        $('#total_amount').val($totalPrice.html())
                        console.log(data)
                    }
                })
                $quantity.val(1)
                 


            })


            // quantity measure js:
            $incriment.on('click', function() {
                if ($update_value < $quantity_limit.html()) {
                    $update_value++;
                    $quantity.val($update_value)
                    $sale_price = {{ $products->sale_price }};
                    $totalPrice.html(($product_price.html() * $update_value));
                    $('#total_amount').val(($product_price.html() * $update_value))
                }
            })

            $decriment.on('click', function() {
                if ($update_value > 1) {
                    $update_value--;
                    $quantity.val($update_value)
                    $sale_price = {{ $products->sale_price }};
                    $totalPrice.html(($product_price.html() * $update_value));
                }
            })

        })
    </script>
@endsection
