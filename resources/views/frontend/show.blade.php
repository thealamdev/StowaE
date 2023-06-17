@extends('layouts.frontapp')
@section('title')
    {{ $products->title }}
@endsection


@section('css')
    <style>
        pre {
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #F5F5F5;
            border: 1px solid #CCC;
            border-radius: 4px;
        }

        .header {
            padding: 20px 0;
            position: relative;
            margin-bottom: 10px;

        }

        .header:after {
            content: "";
            display: block;
            height: 1px;
            background: #eee;
            position: absolute;
            left: 30%;
            right: 30%;
        }

        .header h2 {
            font-size: 3em;
            font-weight: 300;
            margin-bottom: 0.2em;
        }

        .header p {
            font-size: 14px;
        }

        .success-box {
            padding: 10px 10px;
            border: 1px solid #eee;
            background: #f9f9f9;
        }

        .success-box img {
            margin-right: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .success-box>div {
            vertical-align: top;
            display: inline-block;
            color: #888;
        }



        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul>li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul>li.star>i.fa {
            font-size: 2.5em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul>li.star.hover>i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul>li.star.selected>i.fa {
            color: #FF912C;
        }
    </style>
@endsection

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
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button"
                        role="tab" aria-controls="additional_information_tab" aria-selected="false">
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

                    {!! $products->description !!}

                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">

                    {!! $products->additional_info !!}

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
                    
                    @if (Auth::check() && in_array($products->id, $user_order))
                    <div class="customer_review_form">
                        <h4 class="reviews_tab_title">Add a review</h4>
                    

                        <form action="#">

                            <div class="your_ratings">
                                 <div class="rating_box_name">
                                    <h5>Your Ratings:</h5>
                                 </div>
                                  

                                <div class='rating-widget'>

                                    <div class='rating-stars text-center'>
                                        <ul id='stars'>
                                            <li class='star' title='Poor' data-value='1'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                                <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class='success-box' style="display: none">
                                        <div class='clearfix'></div>
                                        <img alt='tick image' width='32'
                                            src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                                        <div class='text-message'></div>
                                    </div>

                                </div>

                            </div>


                            <div class="form_item">
                                <input type="hidden" name="review_star" id="review_star" >
                                <textarea name="comment" placeholder="Your Review*"></textarea>
                            </div>

                            <button type="submit" class="btn btn_primary">Submit Now</button>
                        </form>
                    </div>
                    @endif

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

    <script>
        $(document).ready(function() {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $('#review_star').val(ratingValue)
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";
                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
    </script>
@endsection
