@extends('home.layouts.master')

@section('title', 'فراموشی رمز عبور')

@section('content')
    <!-- PAGE BREADCRUMB -->
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3>فراموشی رمز عبور</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">خانه</a>
                        </li>
                        <li>
                            <a>فراموشی رمز عبور</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SIGN UP -->
    <section class="section-primary sign-up pt-112 pb-90">
        <div class="container rtl text-right">
            <h4>فراموشی رمز عبور</h4>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @include('sections.errors')
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-holder">
                    <label>ایمیل</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user() ? auth()->user()->email : '' }}" required>
                </div>
                <button type="submit" class="btn btn-outline-info">
                    {{ __('ارسال ایمیل تغییر کلمه عبور') }}
                </button>
            </form>
        </div>
    </section>
@endsection
