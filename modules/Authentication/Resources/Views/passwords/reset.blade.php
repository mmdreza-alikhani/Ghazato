@extends('home.layouts.master')

@section('title', 'بازیابی کلمه عبور')

@section('content')
    <!-- PAGE BREADCRUMB -->
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3>بازیابی کلمه عبور</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">خانه</a>
                        </li>
                        <li>
                            <a>بازیابی کلمه عبور</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SIGN UP -->
    <section class="section-primary sign-up pt-112 pb-90">
        <div class="container rtl text-right">
            <h4>بازیابی کلمه عبور</h4>
            @include('sections.errors')
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-holder">
                    <label>ایمیل</label>
                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required>
                </div>

                <div class="form-holder">
                    <label>کلمه عبور جدید</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                </div>
                <div class="form-holder">
                    <label>تکرار کلمه عبور جدید</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('username') }}" required>
                </div>
                <button type="submit" class="btn btn-outline-info">
                    {{ __('بازیابی رمز عبور') }}
                </button>
            </form>
        </div>
    </section>
@endsection
