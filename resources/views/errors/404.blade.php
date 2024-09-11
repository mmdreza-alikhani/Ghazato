@extends('home.layouts.master')

@section('title')
    404
@endsection

@section('content')
    <section class="error set-bg" data-bg="/home/images/dark-bg.jpg">
        <div class="inner rtl">
            <span>404</span>
            <h3>صفحه یافت نشد!</h3>
            <p>
                متاسفیم! صفحه مورد نظر شما یافت نشد. اگر چندین بار به این صفحه برخوردید از
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
