@extends('home.layouts.master')

@section('title', 'تایید ایمیل')

@section('content')
    <!-- PAGE BREADCRUMB -->
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3>تایید ایمیل</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">صفحه اصلی</a>
                        </li>
                        <li>
                            <a>تایید ایمیل</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SIGN IN -->
    <section class="section-primary sign-in pt-112 pb-90">
        <div class="container rtl text-right">
            <div class="woocommerce">
                <h4>ایمیل خود را تایید کنید</h4>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('لینک تازه ای به ایمیل شما ارسال شد.') }}
                    </div>
                @endif

                {{ __('قبل از ادامه لطفا ایمیل خود را بررسی کنید.') }}
                {{ __('اگر ایمیلی دریافت نکرده اید') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('کلیک کنید') }}</button>.
                </form>
            </div>
        </div>
    </section>
@endsection
