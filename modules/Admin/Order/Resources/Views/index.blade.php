@extends('admin.layouts.master')
@section('title')
    سفارشات
@endsection
@php
    $active_parent = 'orders';
    $active_child = 'manageOrders';
@endphp
@section('content')
    <main class="bmd-layout-content">
        <div class="container-fluid">
            <div class="row m-1 pb-4 mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-2">
                    <div class="page-header breadcrumb-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title text-left-rtl">
                                    <div class="d-inline">
                                        <h3 class="lite-text">پنل مدیریت</h3>
                                        <span class="lite-text">سفارشات</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">سفارشات</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <form action="{{ route('admin.orders.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین سفارشات با شناسه" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div>
                    @if($orders->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            سفارشی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">شناسه سفارش</th>
                                <th scope="col">توکن</th>
                                <th scope="col">مبلغ قابل پرداخت</th>
                                <th scope="col">وضعیت پرداخت</th>
                                <th scope="col">نمایش</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <th>
                                        {{ $orders->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->transaction->token }}
                                    </td>
                                    <td>
                                        {{ number_format($order->paying_amount) . 'تومان' }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $order->getRawOriginal('payment_status') ?  'badge-success' : 'badge-danger' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <button type="button" data-target="#showOrder-{{ $order->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showOrder-{{ $order->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $order->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>سفارش دهنده:</label>
                                                            <br>
                                                            <a href="#">
                                                                {{ $order->user->username }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>محل تحویل:(آدرس)</label>
                                                            <p>
                                                                {{ $order->address->title }}
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>کد تخفیف استفاده شده:</label>
                                                            @if($order->coupon_id != null)
                                                                <p>
                                                                    {{ $order->coupon->code . ' ' }}
                                                                    به مبلغ:
                                                                    {{ number_format($order->coupon_amount) }}
                                                                    تومان
                                                                </p>
                                                            @else
                                                                <p>
                                                                    کد تخفیفی در سفارش شما ثبت نشده است!
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>توکن سفارش:</label>
                                                            <p>
                                                                {{ $transaction->token }}
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>تاریخ ثبت سفارش:</label>
                                                            <p>
                                                                {{ verta($order->created_at)->format('%d %B, %Y') }}
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>مبلغ کل:</label>
                                                            <p>
                                                                {{ number_format($order->total_amount) }}
                                                                تومان
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>هزینه ارسال:</label>
                                                            <p>
                                                                {{ number_format($order->delivery_amount) }}
                                                                تومان
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>مبلغ قابل پرداخت:</label>
                                                            <p>
                                                                {{ number_format($order->paying_amount) }}
                                                                تومان
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>نحوه پرداخت:</label>
                                                            <p>
                                                                {{ $order->payment_type }}
                                                            </p>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>وضعیت پرداخت:</label>
                                                            <span class="badge {{ $order->getRawOriginal('payment_status') ?  'badge-success' : 'badge-danger' }}">
                                                                {{ $order->payment_status }}
                                                            </span>
                                                            @if($order->getRawOriginal('payment_status') == 1)
                                                                <p>
                                                                    {{ $transaction->ref_id }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-12 col-lg-3">
                                                            <label>درگاه پرداخت:</label>
                                                            <span class="badge badge-success">
                                                                {{ $transaction->getaway_name }}
                                                            </span>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label>توضیحات:</label>
                                                            @if($order->description == null)
                                                                <p>
                                                                    توضیحاتی ثبت نشده است!
                                                                </p>
                                                            @else
                                                                <textarea>
                                                                    {{ $order->description }}
                                                                </textarea>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        jalaliDatepicker.startWatch({ time: true });
    </script>
@endsection
