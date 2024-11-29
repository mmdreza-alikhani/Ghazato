@extends('home.layouts.profile.master')

@php
    $active = 'bookmarks';
@endphp

@section('profile_title', 'علاقمندی ها')

@section('profile_content')
    <div class="info-box p-4 m-4 w-100 row rounded" style="background-color: rgba(35,41,48,.1)">
        @if($user->bookmarkedFoods->isEmpty())
            لیست علاقمندی شما خالی است!
        @endif
        @foreach($user->bookmarkedFoods as $food)
            <div class="menu-item w-100">
                <h5>
                    <a href="{{ route('home.foods.show', ['food' => $food->slug]) }}" style="font-family: Vazir-SemiBold">{{ $food->title }}</a>
                    <span class="dots"></span>
                    <span class="price px-1">
                    <span class="currency-symbol">
                        <img src="{{ asset('assets/home/images/toman.png') }}" height="25" alt="تومان">
                    </span>
                    <span class="number">{{ number_format($food->price) }}</span>
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
        @endforeach
    </div>
@endsection
