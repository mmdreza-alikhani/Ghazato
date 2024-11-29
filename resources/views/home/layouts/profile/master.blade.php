@extends('home.layouts.master')

@section('title', 'پروفایل')

@section('content')
    <section class="page-info set-bg" data-bg="{{ asset('assets/home/images/shop-bg.jpeg') }}">
        <div class="section-header">
            <h1 class="text-white">{{ $user->username }}</h1>
            <span>~ @yield('profile_title') ~</span>
        </div>
    </section>

    <section class="section-primary pt-150 pb-113 blog-standard">
        <div class="container">
            <div class="row">
                <div class="col-md-9 rtl text-right">
                    @yield('profile_content')
                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <!-- PERSON -->
                        <div class="widgets" style="display: flex; justify-content: center">
                            <img src="{{ Str::contains($user->avatar, 'https://') ? $user->avatar : env('USER_AVATAR_UPLOAD_PATH') . '/' . $user->avatar }}" alt="{{ $user->username }}-avatar" id="output" width="100" height="100" style="border-radius: 25%"/>
                        </div>
                        <!-- CATEGORIES -->
                        <div class="widgets widget_categories rtl text-right">
                            <div class="widget-title">
                                <h5>تنظیمات:</h5>
                            </div>
                            <ul>
                                <li>
                                    <a class="info {{ $active == 'info' ? 'active' : '' }}" href="{{ route('home.profile.info') }}"> مشخصات کاربری </a>
                                </li>
                                <li>
                                    <a class="purchasesHistory {{ $active == 'orders' ? 'active' : '' }}" href="{{ route('home.profile.orders') }}"> تاریخچه خرید ها </a>
                                </li>
                                <li>
                                    <a class="wishlist {{ $active == 'bookmarks' ? 'active' : '' }}" href="{{ route('home.profile.bookmarks') }}"> علاقه مندیها </a>
                                </li>
                                <li>
                                    <a class="comments {{ $active == 'comments' ? 'active' : '' }}" href="{{ route('home.profile.comments') }}"> وضعیت کامنت ها </a>
                                </li>
                                <li>
                                    <a class="addresses {{ $active == 'addresses' ? 'active' : '' }}" href="{{ route('home.profile.addresses.index') }}"> آدرس ها </a>
                                </li>
                                <li>
                                    <a href="{{ route('password.request') }}"> تغییر کلمه عبور </a>
                                </li>
                                @if($user->email_verified_at == null)
                                    <li>
                                        <a href="{{ route('verification.notice') }}"> تایید ایمیل </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"> ({{$user->username}}) نیستید؟ خروج از حساب کاربری  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
