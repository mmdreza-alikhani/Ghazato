@extends('home.layouts.master')

@section('title')
    401
@endsection

@section('content')
    <section class="error set-bg" data-bg="/home/images/dark-bg.jpg">
        <div class="inner rtl">
            <span>401</span>
            <h3>تعداد درخواست غیرمجاز</h3>
            <p>
                درخواست زیادی ارسال شده است! بعدا تلاش کنید.
            </p>
            <a href="{{ route('home.index') }}" class="au-btn au-btn--hover round has-bd extra-long">
                بازگشت به صفحه اصلی
            </a>
        </div>
    </section>
@endsection
