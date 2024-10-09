@extends('admin.layouts.master')
@section('title')
    رستوران ها
@endsection
@php
    $active_parent = 'shops';
    $active_child = 'manageShops';
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
                                        <span class="lite-text">رستوران ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">رستوران ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newShopModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن رستوران جدید
                        </button>
                        <a href="{{ route('admin.shops.trash') }}" class="btn btn-outline-secondary" style="max-width: fit-content">
                            <i class="fa fa-trash"></i>
                            سطل آشغال
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.shops.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین رستوران ها با عنوان یا شناسه" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newShopModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد رستوران جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createShop])
                                <form action="{{ route('admin.shops.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="title">عنوان:*</label>
                                        <input id="title" name="title" type="text" value="{{ old('title') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="adminSelect">ادمین:*</label>
                                        <select id="adminSelect" class="form-control" name="user_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="telephone">شماره تلفن:*</label>
                                        <input id="telephone" name="telephone" type="tel" value="{{ old('telephone') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="telephone2">شماره تلفن دوم:*</label>
                                        <input id="telephone2" name="telephone2" type="text" value="{{ old('telephone2') }}" class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" selected>فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="type">نوع:*</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="fastfood" selected>فست فود</option>
                                            <option value="classic">کلاسیک</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="provinceSelect">استان:*</label>
                                        <div class="input-group mb-3">
                                            <select id="provinceSelect" class="form-control" name="province_id">
                                                <option value="0" selected disabled>استان خود را انتخاب کنید...</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="citySelect">شهر:*</label>
                                        <div class="input-group mb-3">
                                            <select id="citySelect" class="form-control" name="city_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                افزودن تصویر
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="custom-file col-12 m-1">
                                                        <input type="file" id="primary_image" name="primary_image" class="form-control custom-control-input" lang="fa" required>
                                                        <label for="primary_image" class="custom-file-label text-left">تصویر اصلی</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-lg-12">
                                        <label for="address">آدرس:*</label>
                                        <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-12">
                                        <label for="description">توضیحات:*</label>
                                        <input id="description" name="description" type="text" value="{{ old('description') }}" class="form-control" required>
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
                    @if($shops->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            رستورانی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">ادمین</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shops as $key => $shop)
                                <tr>
                                    <th>
                                        {{ $shops->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $shop->title }}
                                    </td>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/usersSearch?keyword=' . $shop->user->username ) }}">
                                            {{ $shop->user->username }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $shop->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $shop->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showShop-{{ $shop->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editShop-{{ $shop->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteShop-{{ $shop->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showShop-{{ $shop->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $shop->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="title">عنوان:*</label>
                                                            <input id="title" type="text" value="{{ $shop->title }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="admin">ادمین:*</label>
                                                            <a href="{{ url('/management/usersSearch?keyword=' . $shop->user->username ) }}">
                                                                {{ $shop->user->username }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="telephone">شماره تلفن:*</label>
                                                            <input id="telephone" type="tel" value="{{ $shop->telephone }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="telephone2">شماره تلفن دوم:*</label>
                                                            <input id="telephone2" type="tel" value="{{ $shop->telephone2 }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="1" {{ $shop->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                <option value="0" {{ $shop->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="type">نوع:*</label>
                                                            <select class="form-control" id="type" disabled>
                                                                <option value="fastfood" {{ $shop->type == 'fastfood' ? 'selected' : '' }}>فست فود</option>
                                                                <option value="classic" {{ $shop->type == 'classic' ? 'selected' : '' }}>کلاسیک</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="province">استان:*</label>
                                                            <input id="province" type="text" value="{{ $shop->province->title }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="city">شهر:*</label>
                                                            <input id="city" type="text" value="{{ $shop->city->title }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-12 col-lg-12 mt-3">
                                                            <div class="card">
                                                                <div class="card-header bg-primary">
                                                                    تصاویر
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-12 mb-5">
                                                                            <h5>
                                                                                تصویر اصلی:
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-12 col-md-12 mb-5">
                                                                            <div class="card">
                                                                                <img class="card-img-top" src="{{ url(env('SHOP_IMAGE_UPLOAD_PATH')) . '/' . $shop->primary_image }}" alt="{{ $shop->title }}-image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label for="address">آدرس:*</label>
                                                            <textarea id="address" type="text" class="form-control" disabled>{{ $shop->address }}</textarea>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label for="description">توضیحات:*</label>
                                                            <textarea id="description" type="text" class="form-control" disabled>{{ $shop->description }}</textarea>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <h4>کد های تخفیف:</h4>
                                                            <div class="row">
                                                                @if($shop->coupons->isEmpty())
                                                                    هیچ کد تخفیفی در دسترس نیست.
                                                                @endif
                                                                @foreach($shop->coupons as $coupon)
                                                                    <div class="form-group col-12 col-lg-3">
                                                                        <h6>{{ $coupon->title . ':' }}
                                                                            <span class="badge f-{{ $coupon->getRawOriginal('status') == 1 ?  'main' : 'warning' }}">
                                                                                {{ $coupon->status }}
                                                                            </span>
                                                                        </h6>
                                                                        <a href="{{ url('/management/couponsSearch?keyword=' . $coupon->title ) }}">
                                                                            {{ $coupon->code }}
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($shop->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($shop->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <a href="{{ url('/management/shopsSearch?keyword=' . $shop->title ) }}" class="btn outlined c-main">نمایش تمام محصولات</a>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify" id="deleteShop-{{ $shop->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $shop->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این رستوران اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.shops.destroy', ['shop' => $shop]) }}" method="POST">
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
                                    <div class="modal w-lg fade light blur" id="editShop-{{ $shop->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $shop->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateShop])
                                                    <form action="{{ route('admin.shops.update' , ['shop' => $shop->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="title">عنوان:*</label>
                                                                <input id="title" name="title" type="text" value="{{ $shop->title }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="adminSelect">ادمین:*</label>
                                                                <select id="adminSelect" class="form-control" name="user_id">
                                                                    @foreach($users as $user)
                                                                        <option value="{{ $user->id }}" {{ $shop->user_id == $user->id ? 'selected' : ''}}>{{ $user->username }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="telephone">شماره تلفن:*</label>
                                                                <input id="telephone" name="telephone" type="text" value="{{ $shop->telephone }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="telephone2">شماره تلفن دوم:*</label>
                                                                <input id="telephone2" name="telephone2" type="text" value="{{ $shop->telephone2 }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="1" {{ $shop->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                    <option value="0" {{ $shop->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="type">نوع:*</label>
                                                                <select class="form-control" id="type" name="type">
                                                                    <option value="fastfood" {{ $shop->type == 'fastfood' ? 'selected' : '' }}>فست فود</option>
                                                                    <option value="classic" {{ $shop->type == 'classic' ? 'selected' : '' }}>کلاسیک</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="provinceSelect-{{ $shop->id }}">استان:*</label>
                                                                <div class="input-group mb-3">
                                                                    <select id="provinceSelect-{{ $shop->id }}" class="form-control" name="province_id">
                                                                        <option value="0" selected disabled>استان خود را انتخاب کنید...</option>
                                                                        @foreach($provinces as $province)
                                                                            <option value="{{ $province->id }}" {{ $province->id == $shop->province_id ? 'selected' : '' }}>{{ $province->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="citySelect-{{ $shop->id }}">شهر:*</label>
                                                                <div class="input-group mb-3">
                                                                    <select id="citySelect-{{ $shop->id }}" class="form-control" name="city_id">
                                                                        @foreach($cities as $city)
                                                                            <option value="{{ $city->id }}" {{ $city->id == $shop->city_id ? 'selected' : '' }}>{{ $city->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                $('#provinceSelect-{{ $shop->id }}').change(function() {

                                                                    var provinceID = $(this).val();

                                                                    if (provinceID) {
                                                                        $.ajax({
                                                                            type: "GET",
                                                                            url: "{{ url('/get_province_cities_list') }}?province_id=" + provinceID,
                                                                            success: function(res) {
                                                                                console.log(res)
                                                                                if (res) {
                                                                                    $("#citySelect-{{ $shop->id }}").empty();

                                                                                    $.each(res, function(key , city) {
                                                                                        $("#citySelect-{{ $shop->id }}").append('<option value="' + city.id + '">' +
                                                                                            city.title + '</option>');
                                                                                    });

                                                                                } else {
                                                                                    $("#citySelect-{{ $shop->id }}").empty();
                                                                                }
                                                                            }
                                                                        });
                                                                    } else {
                                                                        $("#citySelect-{{ $shop->id }}").empty();
                                                                    }
                                                                });
                                                            </script>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="card">
                                                                    <div class="card-header bg-primary">
                                                                        تصویر
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-12 mb-5">
                                                                                <h5>
                                                                                    تصویر اصلی:
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-12 col-md-12 mb-5">
                                                                                <div class="card">
                                                                                    <img class="card-img-top" src="{{ url(env('SHOP_IMAGE_UPLOAD_PATH')) . '/' . $shop->primary_image }}" alt="{{ $shop->title }}-image">
                                                                                </div>
                                                                            </div>
                                                                            <div class="custom-file col-12 m-1">
                                                                                <input type="file" name="primary_image" id="primary_image_update" class="form-control custom-control-input primary_image_update" lang="fa">
                                                                                <label for="primary_image_update" class="custom-file-label text-left">تصویر</label>
                                                                            </div>
                                                                            <script>
                                                                                $('#primary_image_update').change(function() {
                                                                                    const filename = $(this).val();
                                                                                    $(this).next('.custom-file-label').html(filename)
                                                                                })
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="address">آدرس:*</label>
                                                                <textarea id="address" type="text" name="address" class="form-control">{{ $shop->address }}</textarea>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="description">توضیحات:*</label>
                                                                <textarea id="description" type="text" name="description" class="form-control">{{ $shop->description }}</textarea>
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
                                    @if(count($errors->updateShop) > 0)
                                        <script>
                                            $('#editShop-{{ session()->get('shop_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $shops->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        jalaliDatepicker.startWatch({ time: true });
        $('.userSelect').selectpicker({
            'title' : 'انتخاب ادمین'
        });
        @if(count($errors->createshop) > 0)
            $(function() {
                $('#newShopModal').modal({
                    show: true
                });
            });
        @endif
        $('#primary_image').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        $('#provinceSelect').change(function() {

            var provinceID = $(this).val();

            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get_province_cities_list') }}?province_id=" + provinceID,
                    success: function(res) {
                        console.log(res)
                        if (res) {
                            $("#citySelect").empty();

                            $.each(res, function(key , city) {
                                $("#citySelect").append('<option value="' + city.id + '">' +
                                    city.title + '</option>');
                            });

                        } else {
                            $("#citySelect").empty();
                        }
                    }
                });
            } else {
                $("#citySelect").empty();
            }
        });
    </script>
@endsection
