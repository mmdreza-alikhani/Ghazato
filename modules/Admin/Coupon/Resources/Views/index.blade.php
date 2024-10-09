@extends('admin.layouts.master')
@section('title')
    کد های تخفیف
@endsection
@php
    $active_parent = 'coupons';
    $active_child = 'manageCoupons';
@endphp
@section('content')
    <main class="bmd-layout-content">
        <div class="container-fluid">
            <div class="row  m-1 pb-4 mb-3">
                <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 p-2">
                    <div class="page-header breadcrumb-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title text-left-rtl">
                                    <div class="d-inline">
                                        <h3 class="lite-text">پنل مدیریت</h3>
                                        <span class="lite-text">کد های تخفیف</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">کد های تخفیف</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newCouponModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن کد  تخفیف جدید
                        </button>
                        <a href="{{ route('admin.coupons.trash') }}" class="btn btn-outline-secondary" style="max-width: fit-content">
                            <i class="fa fa-trash"></i>
                            سطل آشغال
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.foods.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین کد های تخفیف با عنوان" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newCouponModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد کد  تخفیف جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createCoupon])
                                <form action="{{ route('admin.coupons.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="title">عنوان:*</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="shop_id">رستوران:*</label>
                                        <select id="shop_id" class="form-control" name="shop_id" required>
                                            <option value="0" selected>عمومی(برای همه رستوران ها)</option>
                                            @foreach($shops as $shop)
                                                <option value="{{ $shop->id }}">{{ $shop->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="code">کد:*</label>
                                        <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="type">نوع:*</label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="amount">مبلغی</option>
                                            <option value="percentage">درصدی</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="amount">مبلغ:*</label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="percentage">درصد:*</label>
                                        <input type="number" name="percentage" id="percentage" class="form-control" value="{{ old('percentage') }}" minlength="1" maxlength="3">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی:*</label>
                                        <input type="number" name="max_percentage_amount" id="max_percentage_amount" class="form-control" value="{{ old('max_percentage_amount') }}">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="expired_at">تاریخ انقضا:*</label>
                                        <input data-jdp name="expired_at" id="expired_at" class="form-control" value="{{ old('expired_at') }}">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="0">غیرفعال</option>
                                            <option value="1" >فعال</option>
                                            <option value="2" >منقضی</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-12">
                                        <label for="description">توضیحات:*</label>
                                        <textarea type="text" name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn outlined f-main">افزودن</button>
                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>

                <div>
                    @if($coupons->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            کد  تخفیفی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">کد</th>
                                <th scope="col">نوع</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $key => $coupon)
                                <tr>
                                    <th>
                                        {{ $coupons->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $coupon->title }}
                                    </td>
                                    <td>
                                        {{ $coupon->code }}
                                    </td>
                                    <td>
                                        {{ $coupon->type }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $coupon->getRawOriginal('status') == 1 ?  'main' : 'warning' }}">
                                            {{ $coupon->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showCoupon-{{ $coupon->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editCoupon-{{ $coupon->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteCoupon-{{ $coupon->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showCoupon-{{ $coupon->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $coupon->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="title">عنوان:*</label>
                                                            <input type="text" id="title" class="form-control" value="{{ $coupon->title }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="shop_id">رستوران:*</label>
                                                            <select id="shop_id" class="form-control" disabled>
                                                                <option value="0" {{ $coupon->shop_id == '0' ? 'selected' : ''}}>عمومی(برای همه رستوران ها)</option>
                                                                @foreach($shops as $shop)
                                                                    <option value="{{ $shop->id }}" {{ $coupon->shop_id == $shop->id ? 'selected' : ''}}>{{ $shop->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="code">کد:*</label>
                                                            <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="type">نوع:*</label>
                                                            <select class="form-control" id="type" disabled>
                                                                <option {{ $coupon->type == 'amount' ? 'selected' : '' }} value="amount">مبلغی</option>
                                                                <option {{ $coupon->type == 'percentage' ? 'selected' : '' }} value="percentage">درصدی</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="amount">مبلغ:*</label>
                                                            <input type="text" id="amount" class="form-control" value="{{ number_format($coupon->amount) }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="percentage">درصد:*</label>
                                                            <input type="number" id="percentage" class="form-control" value="{{ $coupon->percentage }}" minlength="1" maxlength="3" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی:*</label>
                                                            <input type="number" id="max_percentage_amount" class="form-control" value="{{ number_format($coupon->max_percentage_amount) }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="expired_at">تاریخ انقضا:*</label>
                                                            <input id="expired_at" class="form-control" value="{{ $coupon->expired_at }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="0" {{ $coupon->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                <option value="1" {{ $coupon->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                <option value="1" {{ $coupon->getRawOriginal('status') == 3 ? 'selected' : '' }}>منقضی شده</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label for="description">توضیحات:*</label>
                                                            <textarea type="text" id="description" class="form-control" disabled>{{ $coupon->description }}</textarea>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($coupon->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($coupon->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify" id="deleteCoupon-{{ $coupon->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $coupon->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این کد  تخفیف اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.coupons.destroy', ['coupon' => $coupon]) }}" method="POST">
                                                    <div class="modal-footer">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="btn outlined o-main c-main" data-dismiss="modal">بازگشت</button>
                                                        <button type="submit" class="btn outlined f-danger">حذف</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade light blur" id="editCoupon-{{ $coupon->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $coupon->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateCoupon])
                                                    <form action="{{ route('admin.coupons.update' , ['coupon' => $coupon->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="title">عنوان:*</label>
                                                                <input type="text" name="title" id="title" class="form-control" value="{{ $coupon->title }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="shop_id">رستوران:*</label>
                                                                <select id="shop_id" name="shop_id" class="form-control" required>
                                                                    <option value="0" {{ $coupon->shop_id == '0' ? 'selected' : ''}}>عمومی(برای همه رستوران ها)</option>
                                                                    @foreach($shops as $shop)
                                                                        <option value="{{ $shop->id }}" {{ $coupon->shop_id == $shop->id ? 'selected' : ''}}>{{ $shop->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="code">کد:*</label>
                                                                <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="type">نوع:*</label>
                                                                <select class="form-control" id="type" name="type" required>
                                                                    <option {{ $coupon->getRawOriginal('type') == 'amount' ? 'selected' : '' }} value="amount">مبلغی</option>
                                                                    <option {{ $coupon->getRawOriginal('type') == 'percentage' ? 'selected' : '' }} value="percentage">درصدی</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="amount">مبلغ:*</label>
                                                                <input type="text" id="amount" name="amount" class="form-control" value="{{ $coupon->amount }}">
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="percentage">درصد:*</label>
                                                                <input type="number" id="percentage" name="percentage" class="form-control" value="{{ $coupon->percentage }}" minlength="1" maxlength="3">
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="max_percentage_amount">حداکثر مبلغ برای نوع درصدی:*</label>
                                                                <input type="number" id="max_percentage_amount" name="max_percentage_amount" class="form-control" value="{{ $coupon->max_percentage_amount }}">
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="expired_at">تاریخ انقضا:*</label>
                                                                <input data-jdp name="expired_at" id="expired_at" class="form-control" value="{{ verta($coupon->expired_at)->formatJalaliDatetime() }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="0" {{ $coupon->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                    <option value="1" {{ $coupon->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                    <option value="0" {{ $coupon->getRawOriginal('status') == 2 ? 'selected' : '' }}>منقضی</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="description">توضیحات:*</label>
                                                                <textarea type="text" name="description" id="description" class="form-control" required>{{ $coupon->description }}</textarea>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn outlined f-main">ویرایش</button>
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($errors->updateCoupon) > 0)
                                        <script>
                                            $('#editCoupon-{{ session()->get('coupon_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $coupons->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        jalaliDatepicker.startWatch({ time: true });
        $('#image').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        $('#image_update').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        @if(count($errors->createCoupon) > 0)
            $(function() {
                $('#newCouponModal').modal({
                    show: true
                });
            });
        @endif
    </script>
@endsection
