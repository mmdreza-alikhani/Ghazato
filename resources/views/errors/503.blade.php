@extends('home.layouts.master')

@section('title')
    503
@endsection

@section('content')
    <section class="error set-bg" data-bg="/home/images/dark-bg.jpg">
        <div class="inner rtl">
            <span>503</span>
            <h3>خطای داخلی سرور</h3>
            <p>
                متاسفیم! سیستم با خطا مواجه شده! اگر چندین بار به این صفحه برخوردید از
                <a href="#feedback">
                    اینجا
                </a>
                به ما اطلاع بدید.
            </p>
            <a href="{{ route('home.index') }}" class="au-btn au-btn--hover round has-bd extra-long">
                بازگشت به صفحه اصلی
            </a>
        </div>
    </section>
@endsection
