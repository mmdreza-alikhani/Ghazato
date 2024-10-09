@extends('home.layouts.master')

@section('title', 'ورود')

@section('content')
    <!-- PAGE BREADCRUMB -->
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3 class="text-white text-right">حساب کاربری من</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">صفحه اصلی</a>
                        </li>
                        <li>
                            <a>حساب کاربری من</a>
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
                <h4>ورود</h4>
                @include('sections.errors')
                <form action="{{ route('login') }}" method="post" class="woocommerce-form woocommerce-form-login login">
                    @csrf
                    <div class="form-holder">
                        <label for="email">ایمیل:<span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-holder">
                        <label for="password">کلمه عبور:<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" value="{{ old('password') }}">
                    </div>
                    <div class="form-holder last">
                        <button type="submit" class="btn btn-outline-info">
                            {{ __('ورود') }}
                        </button>
{{--                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">--}}
{{--                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">--}}
{{--                            Remember me--}}
{{--                            <span class="checkmark"></span>--}}
{{--                        </label>--}}
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('رمز عبور خود را فراموش کرده اید؟') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection
