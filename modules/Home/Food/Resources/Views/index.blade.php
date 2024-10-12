@extends('home.layouts.master')

@php
    $active = ''
@endphp

@php
//    if (auth()->check()){
//        $cart = \App\Models\Cart::where('user_id', '=', auth()->user()->id)->first();
//        dd($cart);
//    }
@endphp

@section('title', $food->title)

@section('content')
    <section class="page-info set-bg" data-bg="/home/images/shop-bg.jpeg">
        <div class="section-header">
            <h1 class="text-white">{{ $food->title }}</h1>
            <span>~ {{ $food->category->title }} ~</span>
        </div>
    </section>

    <!-- SHOP SINGLE -->
    <section class="section-primary pt-150 pb-113 shop-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images">
                        <figure class="woocommerce-product-gallery__wrapper">
                            <div class="woocommerce-product-gallery__image">
                                <img id="zoom-image" class="attachment-shop_single size-shop_single wp-post-image" src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $food->primary_image }}" data-zoom-image="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $food->primary_image }}" alt="{{ $food->primary_image . '-image' }}" />
                            </div>
                        </figure>
                        <div id="shop-single-thumb">
                            @foreach($food->images as $image)
                                <a data-image="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $image->image }}" data-zoom-image="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $image->image }}">
                                    <img src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $image->image }}" alt="{{ $food->title . '-' . $image->image . '-image' }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="summary entry-summary">
                        <h3 class="product_title entry-title text-right">{{ $food->title }}</h3>
                        <div class="info">
                            <span class="price">
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">
                                        <img src="/home/images/toman.png" height="25" alt="تومان">
                                    </span>
                                    <span class="number" style="font-family: Vazir-Bold">{{ number_format($food->price) }}</span>
                                </span>
                            </span>
                            <span class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </span>
                        </div>
                        <div class="woocommerce-product-details__short-description rtl text-right">
                            <p>
                                {{ $food->description }}
                            </p>
                        </div>
                        <form class="cart" method="post" action="{{ route('home.cart.add') }}">
                            @csrf
                            <div class="quantity">
                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                <input type="number" class="input-text qty text" min="1" max="10" name="quantity" value="1" id="input-quantity">
                                <div class="icon">
                                    <a href="#" class="number-button plus">+</a>
                                    <a href="#" class="number-button minus">-</a>
                                </div>
                            </div>
                            <button type="submit" class="single_add_to_cart_button button alt au-btn round has-bg au-btn--hover">افزودن به سبد خرید</button>
                        </form>
                        <div class="product_meta rtl text-right">
                            <span class="sku_wrapper">شناسه انبار: <span class="sku">{{ $food->sku }}</span></span>
                            <span class="posted_in">دسته بندی: <a href="#" rel="tag">{{ $food->category->title }}</a></span>
                            <span class="tagged_as">ترکیبات:
                                @foreach($food->ingredients as $ingredient)
                                    <a rel="tag">{{ $ingredient->title }}</a>{{ $loop->last ? '' : ',' }}
                                @endforeach
                            </span>
                        </div>
                        <div class="social">
                            <a href="#">
                                <i class="zmdi zmdi-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-facebook-box"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-linkedin"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- WOOCOMMERCE TABS -->
            <div class="woocommerce-tabs wc-tabs-wrapper rtl text-right">
                <div id="shop-single-tab">
                    <ul class="tabs wc-tabs">
                        <li class="description_tab">
                            <a href="#description">مشخصات غذا</a>
                        </li>
                        <li class="additional_information_tab">
                            <a href="#shop-description">مشخصات رستوران</a>
                        </li>
                        <li class="reviews_tab">
                            <a href="#review">نظرات ({{ $food->comments->count() }})</a>
                        </li>
                    </ul>
                    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="description">
                        <p>
                            {{ $food->description }}
                        </p>
                    </div>
                    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab" id="shop-description">
                        <p>
                            {{ $food->shop->description }}
                        </p>
                    </div>
                    <div id="review" class="woocommerce-Reviews">
                        <div id="comments">
                        @if($food->comments->isEmpty())
                            <h6 class="woocommerce-noreviews alert alert-info">
                                اولین نظر رو ثبت کنید.
                            </h6>
                        @else
                            @include('home.sections.comments' , ['comments' => $food->comments])
                        @endif
                        </div>
                        <div id="review_form_wrapper" class="mt-4">
                            <div id="review_form">
                                @if(auth()->check())
                                    <div id="respond" class="comment-respond">
                                        <form method="post" action="{{ route('home.foods.comments.store', ['food' => $food->id]) }}" id="comments-form" class="comments-form">
                                            @include('sections.errors', ['errors' => $errors->createComment])
                                            @csrf
                                            <h4 id="addComment" class="rtl text-right">
                                                نظر بدهید:
                                            </h4>
                                            <p class="comment-form-comment">
                                                <textarea class="form-control required" name="text" rows="5" placeholder="نظر شما *">{{ old('text') }}</textarea>
                                                <input type="hidden" name="rate" id="rateInput" value="0">
                                                <input type="hidden" name="replyOf" id="replyOf" value="0">
                                            </p>
                                            <div class="comment-form-rating">
                                                <label>امتیاز دهی:</label>
                                                <div id="rating"
                                                     data-rating-stars="5"
                                                     data-rating-value="1"
                                                     data-rating-input="#rateInput">
                                                </div>
                                            </div>
                                            <p class="form-submit">
                                                <button class="btn btn-success" type="submit">ثبت</button>
                                            </p>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-secondary rtl text-right">
                                        لطفا قبل از نظر دادن
                                        <a href="{{ route('login') }}">
                                            وارد
                                        </a>
                                        شوید.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RELATED PRODUCT -->
            <div class="related products">
                <h4>آیتم های غذایی مرتبط با: {{ $food->title }}</h4>
                <div class="row">
                    @foreach($related as $food)
                        <div class="col-md-4 col-lg-3">
                            <div class="item">
                                <div class="thumb">
                                    <a href="#" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <img src="images/shop-list-4.jpg" alt="">
                                    </a>
                                    <a href="#" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Add to cart</a>
                                </div>
                                <div class="info">
                                    <h5 class="woocommerce-loop-product__title">
                                        <a href="#">Angela's Awesome</a>
                                    </h5>
                                    <div class="star-rating">
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star"></i>
                                        <i class="zmdi zmdi-star-outline"></i>
                                    </div>
                                    <span class="price">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>28
                                    </span>
                                </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('.replyBtn').on('click', function (){
            $('#replyOf').val($(this).data('id'))
        })
    </script>
@endsection
