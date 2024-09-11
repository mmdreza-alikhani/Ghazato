@extends('home.layouts.master')

@section('title')
    403
@endsection

@section('content')
    <section class="error set-bg" data-bg="/home/images/dark-bg.jpg">
        <div class="inner rtl">
            <span>403</span>
            <h3>دسترسی ممنوع است</h3>
            <p>
                شما واجد شرایط برای ورود به این صفحه نیستید.
            </p>
            <a href="{{ route('home.index') }}" class="au-btn au-btn--hover round has-bd extra-long">
                بازگشت به صفحه اصلی
            </a>
        </div>
    </section>
@endsection
