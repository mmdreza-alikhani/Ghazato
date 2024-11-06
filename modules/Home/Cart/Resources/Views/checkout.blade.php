@extends('home.layouts.master')

@section('title', 'نهایی کردن')

@php
    $active = 'checkout';
@endphp

@section('content')
    <section class="page-breadcrumb rtl">
        <div class="container">
            <div class="row justify-content-between align-content-center">
                <div class="col-md-auto">
                    <h3 class="text-white text-right">نهایی کردن خرید</h3>
                </div>
                <div class="col-md-auto">
                    <ul class="au-breadcrumb">
                        <li>
                            <a href="{{ route('home.index') }}">صفحه اصلی</a>
                        </li>
                        <li>
                            <a>نهایی کردن خرید</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-page section-primary pt-120 text-right rtl">
            <div class="container">
                <div class="woocommerce">
                    <div class="woocommerce-info-wrapper">
                        <div id="accordion">
                            <div class="woocommerce-info">
                                <img src="/home/images/have-a-coupon.png" alt="">
                                کد تخفیف دارید؟
                                <a href="#" data-toggle="collapse" data-target="#collapseTwo" id="headingTwo"> کلیک کنید</a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <form class="checkout_coupon" action="{{ route('home.cart.checkCoupon', ['shop' => $cart->shop->slug]) }}" method="post">
                                    @csrf
                                    <p class="form-row form-row-first">
                                        <input type="text" name="coupon_code" class="form-control" placeholder="وارد کنید..." id="coupon_code" value="{{ old('coupon_code') }}">
                                    </p>
                                    <p class="form-row form-row-last">
                                        <input type="submit" class="button au-btn has-bg round" value="ثبت کد">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>

                    <form method="get" class="checkout woocommerce-checkout">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="woocommerce-billing-fields">
                                    <h5>انتخاب آدرس:</h5>
                                    <div class="woocommerce-billing-fields__field-wrapper">
                                        <p class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated row" id="billing_country_field">
                                        @if($addresses->count() == 0)
                                            <div class="col-12 col-lg-8">
                                                <div class="alert alert-danger">
                                                    شما هیچ آدرسی ثبت نکرده اید!
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <a id="addNewAddress" class="button au-btn has-bg" href="{{ route('home.profile.addresses.create') }}">
                                                    افزودن آدرس جدید
                                                </a>
                                            </div>
                                        @else
                                                <label for="address">انتخاب آدرس <span class="text-main-1">*</span>:</label>
                                                <select name="address_id" class="form-control required ltr" id="address_id">
                                                    @foreach($addresses as $address)
                                                        <option value="{{ $address->id }}">{{ $address->title }}</option>
                                                    @endforeach
                                                </select>

                                            <div>
                                                <label for="addNewAddress">آدرس جدید؟ </label>
                                                <a id="addNewAddress" href="{{ route('home.profile.addresses.create') }}">
                                                    افزودن آدرس جدید
                                                </a>
                                            </div>

                                            <label for="description">توضیحات <span class="text-main-1"></span>:</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="توضیحاتی در رابطه با سفارش شما..." rows="6"></textarea>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="woocommerce-checkout-review-order-wrap">
                                    <h5 id="order_review_heading">سفارش شما از فروشگاه {{ $cart->shop->title }}:</h5>

                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <tbody>
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            @foreach($cart->items as $item)
                                                @php
                                                    $totalPrice += $item->food->price*$item->quantity;
                                                @endphp
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <div class="review-wrap">
                                                            <span class="rv-titel">{{ $item->food->title }}</span>
                                                            <span class="product-quantity">x{{ $item->quantity }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            {{ number_format($item->price) }}
                                                            <span class="woocommerce-Price-currencySymbol"> تومان </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="cart-total">
                                            <div class="cart-subtotal">
                                                <p>
                                                    <span class="title">جمع کل: </span>
                                                    <span class="woocommerce-Price-amount amount">
                                                        {{ number_format($totalPrice) }}
                                                        <span class="woocommerce-Price-currencySymbol"> تومان </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="shipping">
                                                <p>
                                                    <span class="title">حمل و نقل: </span>
                                                    <span class="woocommerce-Price-amount amount">
                                                        {{ number_format(\App\Models\Setting::pluck('delivery_amount')->first()) }}
                                                        <span class="woocommerce-Price-currencySymbol"> تومان </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="shipping">
                                                <p>
                                                    <span class="title">کد تخفیف: </span>
                                                    <span class="woocommerce-Price-amount amount">
                                                        {{ number_format(\App\Models\Setting::pluck('delivery_amount')->first()) }}
                                                        <span class="woocommerce-Price-currencySymbol"> تومان </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="order-total">
                                                <p>
                                                    <span class="title">مقدار پرداختی: </span>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">$</span>102
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <ul class="wc_payment_methods payment_methods methods" id="accordion-1">
                                                <li class="wc_payment_method payment_method_cheque">
                                                    <label for="payment_method_cheque"  data-toggle="collapse" data-target="#collapseOne-1" id="headingOne-1">
                                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="" checked>
                                                        Check payments
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <div id="collapseOne-1" class="collapse show" data-parent="#accordion-1">
                                                        <div class="payment_box payment_method_cheque">
                                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="wc_payment_method payment_method_cod">
                                                    <div class="paypal">
                                                        <label for="payment_method_cod"  data-toggle="collapse" data-target="#collapseTwo-1" id="headingTwo-1">
                                                            <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="">
                                                            Paypal
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <div class="payment_box payment_method_cod">
                                                            <img src="images/paypal.png" alt="">
                                                            <a href="#">What is paypal?</a>
                                                        </div>
                                                    </div>
                                                    <div id="collapseTwo-1" class="collapse" data-parent="#accordion-1">
                                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="form-row place-order">
                                                <input type="submit" class="button alt au-btn round has-bg" name="woocommerce_checkout_place_order" id="place_order" value="Poceed to paypal" data-value="Place order">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
@endsection
