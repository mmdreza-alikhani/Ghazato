@extends('home.layouts.master')

@section('title', $shop->title)

@section('content')
    <section class="page-info set-bg" data-bg="/home/images/page-info-bg-3.jpg">
        <div class="section-header">
            <h1 class="text-white">{{ $shop->title }}</h1>
            <span>~ آیتم های غذایی ما ~</span>
        </div>
    </section>

    @foreach($categories as $category)
        <section class="section-primary menu-page pb-120">
            <div class="container">
                <div class="section-header">
                    <h2>{{ $category->title }}</h2>
                    <span>~ Qualities in each dish ~</span>
                </div>
                <div class="row my-1 rtl">
                    @foreach($category->foods as $food)
                        <div class="col-md-6 menu-holder {{ $loop->iteration / 2 != 0 ? 'left' : 'right'}}">
                            <a href="{{ route('home.foods.show', ['food' => $food->slug]) }}" class="menu-thumb">
                                <img src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $food->primary_image }}" alt="" height="50">
                            </a>
                            <div class="menu-item">
                                <h5 class="bold-color">
                                    <a href="{{ route('home.foods.show', ['food' => $food->slug]) }}" style="font-family: Vazir-Bold">{{ $food->title }}</a>
                                    <span class="dots"></span>
                                    <span class="price">
                                    <span class="currency-symbol">
                                        <img src="/home/images/toman.png" height="25" alt="تومان">
                                    </span>
                                    <span class="number" style="font-family: Vazir-Bold">{{ number_format($food->price) }}</span>
                                </span>
                                </h5>
                                <ul>
                                    @foreach($food->ingredients as $ingredient)
                                        <li>
                                            <a>{{ $ingredient->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
@endsection
