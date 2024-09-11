@extends('home.layouts.master')

@section('title', 'رستوران ها')

@section('content')
    <!-- PAGE INFO -->
    <section class="page-info set-bg" data-bg="/home/images/restaurant-bg.jpg">
        <div class="section-header">
            <h1 class="text-white">تمامی رستوران ها</h1>
            <span>~ The people behind the dishes ~</span>
        </div>
    </section>

    <!-- OUR CHEF -->
    <section class="section-primary pb-50 our-chef rtl">
        <div class="container">
            <div class="section-header">
                <h2>رستوران کلاسیک</h2>
                <span>~ غذای ایرانی ~</span>
            </div>
            <div class="row">
                @foreach($classicShops as $classicShop)
                    <a class="text-white font-weight-bold" href="{{ route('home.shops.show', ['shop' => $classicShop->slug]) }}">
                        <div class="col-md-6 col-lg-3">
                            <div class="our-chef-item">
                                <img src="{{ url(env('SHOP_IMAGE_UPLOAD_PATH')) . '/' . $classicShop->primary_image }}" alt="">
                                <div class="info">
                                    <div class="inner">
                                        آیتم های رستوران
                                    </div>
                                </div>
                                <div class="name-box">
                                    <div class="inner">
                                        <h6>
                                            <a href="{{ route('home.shops.show', ['shop' => $classicShop->slug]) }}">{{ $classicShop->title }}</a>
                                        </h6>
                                        <span>{{ $classicShop->city->title . ' - ' . $classicShop->province->title }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="container">
            <div class="section-header">
                <h2>رستوران فست فود</h2>
                <span>~ غذای فست فود ~</span>
            </div>
            <div class="row">
                @foreach($fastfoodShops as $fastfoodShop)
                    <a class="text-white font-weight-bold" href="{{ route('home.shops.show', ['shop' => $fastfoodShop->slug]) }}">
                        <div class="col-md-6 col-lg-3">
                            <div class="our-chef-item">
                                <img src="{{ url(env('SHOP_IMAGE_UPLOAD_PATH')) . '/' . $fastfoodShop->primary_image }}" alt="">
                                <div class="info">
                                    <div class="inner">
                                        آیتم های رستوران
                                    </div>
                                </div>
                                <div class="name-box">
                                    <div class="inner">
                                        <h6>
                                            <a href="{{ route('home.shops.show', ['shop' => $fastfoodShop->slug]) }}">{{ $fastfoodShop->title }}</a>
                                        </h6>
                                        <span>{{ $fastfoodShop->city->title . ' - ' . $fastfoodShop->province->title }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
