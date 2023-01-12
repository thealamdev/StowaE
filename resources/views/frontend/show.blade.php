@extends('layouts.frontapp')
@section('title', 'Product-show')
@section('frontPageContent')
    <div class="container">
        <div class="row mt-4">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">
                        
                        @foreach ($products->product_gallaries as $gallary)
                        <div class="slider_item">
                            <img src="{{ asset('storage/gallary/' .$gallary->image) }}" alt="image_not_found">
                        </div>
                        @endforeach
                    
                         
                    </div>

                    <div class="details_image_carousel_nav">
                        @foreach ($products->product_gallaries as $gallary)
                        <div class="slider_item">
                            <img src="{{ asset('storage/gallary/' .$gallary->image) }}" alt="image_not_found">
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
                            <li><i class="fas fa-star"></i>&gt;</li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star-half-alt"></i></li>
                        </ul>
                        <span class="review_value">3 Rating(s)</span>
                    </div>

                    <div class="item_price">
                        <span>${{ $products->sale_price }}</span>
                        <del>
                            @if ($products->discount)
                                ${{ $products->price }}
                            @endif
                        </del>
                    </div>
                    <hr>

                    <div class="item_attribute">
                        <h3 class="title_text">Options <span class="underline"></span></h3>
                        <form action="#">
 
                                  
                            <div class="row">
                                <div class="col col-md-6">
                                     
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Size *</h4>
                                        <select style="display: none;">
                                            
                                            <option data-display="- Please select -">Choose A Option</option>
                                             
                                            @forelse ($colorSize->inventories as $inventory)
                                            <option value="{{ $inventory->id }}">{{ $inventory->size->name }}</option>
                                            @empty
                                                {{ "No color found" }}
                                            @endforelse

                                        </select>
                                        <div class="nice-select" tabindex="0"><span class="current">- Please select
                                                -</span>
                                            <ul class="list">
                                                <li data-value="Choose A Option" data-display="- Please select -"
                                                    class="option selected">Choose A Option</li>

                                                @forelse ($colorSize->inventories as $inventory)
                                                <li data-value="{{ $inventory->id }}" class="option">{{ $inventory->size->name }}</li>
                                                @empty
                                                <li class="option">{{ "No Color Available" }}</li>
                                                @endforelse

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="select_option clearfix">
                                        <h4 class="input_title">Color *</h4>
                                        <select style="display: none;">
                                            <option data-display="- Please select -">Choose A Option</option>
                                            @forelse ($inventory_color as $key => $inv_color)
                                            <option value="{{ $inv_color->id }}">{{ $inv_color->name }}</option>
                                            @empty
                                                {{ "No color found" }}
                                            @endforelse
                                        </select>
                                        <div class="nice-select" tabindex="0"><span class="current">- Please select
                                                -</span>
                                            <ul class="list">
                                                <li data-value="Choose A Option" data-display="- Please select -"
                                                    class="option selected">Choose A Option</li>
                                                    @forelse ($inventory_color as $key => $inv_color)
                                                    <li data-value="{{ $inv_color->id }}" class="option">{{ $inv_color->name }}</li>
                                                    @empty
                                                    <li class="option">{{ "No Color Available" }}</li>
                                                    @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             

                            <span class="repuired_text">Repuired Fiields *</span>
                        </form>
                    </div>

                    <div class="quantity_wrap">
                        <form action="#">
                            <div class="quantity_input">
                                <button type="button" class="input_number_decrement">
                                    <i class="fal fa-minus"></i>
                                </button>
                                <input class="input_number" type="text" value="1">
                                <button type="button" class="input_number_increment">
                                    <i class="fal fa-plus"></i>
                                </button>
                            </div>
                        </form>

                        <div class="total_price">Total: $620,99</div>
                    </div>

                    <ul class="default_btns_group ul_li">
                        <li><a class="btn btn_primary addtocart_btn" href="#!">Add To Cart</a></li>
                        <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                        <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                    </ul>

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
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique
                        auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper.
                        Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
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
                        Return into stiff sections the bedding was hardly able to cover it and seemed ready to slide off any
                        moment. His many legs, pitifully thin compared with the size of the rest of him, waved about
                        helplessly as he looked what's happened to me he thought It wasn't a dream. His room, a proper human
                        room although a little too small
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
