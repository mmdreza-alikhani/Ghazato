@extends('home.layouts.master')

@section('title', 'ساخت حساب کاربری')

@section('content')
    <!-- PAGE BREADCRUMB -->
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3>ساختن حساب کاربری</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">خانه</a>
                        </li>
                        <li>
                            <a>ساخت حساب کاربری</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SIGN UP -->
    <section class="section-primary sign-up pt-112 pb-90">
        <div class="container rtl text-right">
            <h4>ساخت حساب کاربری</h4>
            @include('sections.errors')
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-holder">
                    <label>نام کاربری</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                </div>

                <div class="form-holder">
                    <label>ایمیل</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-holder">
                    <label>کلمه عبور</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-holder">
                    <label>تکرار کلمه عبور</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-outline-info">
                    {{ __('ثبت') }}
                </button>
                <a href="shop-list.html" class="return-link">Return to Store</a>
            </form>
        </div>
    </section>
@endsection
