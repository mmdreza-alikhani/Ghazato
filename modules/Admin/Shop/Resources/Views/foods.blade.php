@extends('admin.layouts.master')
@section('title')
    غذا های: {{ $shop->title }}
@endsection
@php
    $active_parent = 'shop';
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
                                        <span class="lite-text">غذا های: {{ $shop->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">غذا های: {{ $shop->title }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newFoodModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن غذای جدید
                        </button>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newFoodModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد غذای جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createFood])
                                <form action="{{ route('admin.foods.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="title">عنوان:*</label>
                                        <input id="title" name="title" type="text" value="{{ old('title') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="category_id">دسته بندی:*</label>
                                        <select id="category_id" class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="ingredientSelect">ترکیبات:*</label>
                                        <select id="ingredientSelect" class="form-control ingredientSelect" name="ingredient_ids[]" multiple data-live-search="true">
                                            @foreach($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="shop_id">رستوران:*</label>
                                        <select id="shop_id" class="form-control" name="shop_id">
                                            <option value="{{ $shop->id }}">{{ $shop->title }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="sku">شناسه انبار(sku):*</label>
                                        <input id="sku" name="sku" type="text" value="{{ old('sku') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="price">قیمت(به ریال):*</label>
                                        <input id="price" name="price" type="text" value="{{ old('price') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" selected>انتشار</option>
                                            <option value="0">تعلیق</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_vegan" name="is_vegan">
                                            <label class="form-check-label" for="is_vegan">
                                                مناسب برای گیاهخواران
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-lg-12">
                                        <label for="description">توضیحات:*</label>
                                        <textarea id="description" type="text" name="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                افزودن تصویر
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="custom-file col-12 col-lg-6">
                                                        <input type="file" id="primary_image" name="primary_image" class="form-control custom-control-input" lang="fa">
                                                        <label for="primary_image" class="custom-file-label text-left">تصویر اصلی</label>
                                                    </div>
                                                    <div class="custom-file col-12 col-lg-6">
                                                        <input type="file" name="other_images[]" id="other_images" class="form-control custom-control-input" lang="fa" multiple>
                                                        <label for="other_images" class="custom-file-label text-left">دیگر تصاویر</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                    @if($foods->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            غذایی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">شناسه</th>
                                <th scope="col">تخفیف</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($foods as $key => $food)
                                <tr>
                                    <th>
                                        {{ $foods->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $food->title }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $food->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $food->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $food->sku }}
                                    </td>
                                    <td>
                                        @if($food->is_discounted())
                                            <span class="badge badge-info">
                                                شامل تخفیف
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                بدون تخفیف
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showFood-{{ $food->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editFood-{{ $food->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteFood-{{ $food->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showFood-{{ $food->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $food->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="title">عنوان:*</label>
                                                            <input id="title" type="text" value="{{ $food->title }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="category_id">دسته بندی:*</label>
                                                            <select id="category_id" class="form-control" disabled>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="ingredientSelect">ترکیبات:*</label>
                                                            <select id="ingredientSelect" class="form-control ingredientSelect" disabled multiple data-live-search="true">
                                                                @foreach($ingredients as $ingredient)
                                                                    <option value="{{ $ingredient->id }}"
                                                                        {{ in_array($ingredient->id , $food->ingredients()->pluck('id')->toArray() ) ? 'selected' : '' }}
                                                                    >{{ $ingredient->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="shop_id">رستوران:*</label>
                                                            <select id="shop_id" class="form-control" disabled>
                                                                <option value="{{ $shop->id }}" selected>{{ $shop->title }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="sku">شناسه انبار(sku):*</label>
                                                            <input id="sku" type="text" value="{{ $food->sku }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="price">قیمت(به ریال):*</label>
                                                            <input id="price" type="text" value="{{ $food->price }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="1" {{ $food->getRawOriginal('status') == 1 ? 'selected' : '' }}>انتشار</option>
                                                                <option value="0" {{ $food->getRawOriginal('status') == 0 ? 'selected' : '' }}>تعلیق</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="is_vegan" {{ $food->getRawOriginal('is_vegan') == 1 ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label" for="is_vegan">
                                                                    مناسب برای گیاهخواران
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label for="description">توضیحات:*</label>
                                                            <textarea id="description" type="text" class="form-control" disabled>{{ $food->description }}</textarea>
                                                        </div>
                                                        <div class="col-12 col-lg-12">
                                                            <div class="card">
                                                                <div class="card-header bg-primary">
                                                                    تخفیف
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="form-group col-12 col-md-3">
                                                                            <label for="discounted_price">قیمت حراجی</label>
                                                                            <input id="discounted_price" type="text" value="{{ $food->discounted_price }}" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-3">
                                                                            <label for="discounted_quantity">تعداد حراجی</label>
                                                                            <input id="discounted_quantity" type="number" value="{{ $food->discounted_quantity }}" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-3">
                                                                            <label for="date_on_sale_from">تاریخ شروع حراجی</label>
                                                                            <input data-jdp id="date_on_sale_from" value="{{ $food->date_on_sale_from === null ? null : verta($food->date_on_sale_from) }}" class="form-control text-left" disabled>
                                                                        </div>
                                                                        <div class="form-group col-12 col-md-3">
                                                                            <label for="date_on_sale_to">تاریخ پایان حراجی</label>
                                                                            <input data-jdp id="date_on_sale_to" value="{{ $food->date_on_sale_to === null ? null : verta($food->date_on_sale_to) }}" class="form-control text-left" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                        <div class="col-12 col-md-3 mb-5">
                                                                            <div class="card">
                                                                                <img class="card-img-top" src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $food->primary_image }}" alt="{{ $food->title }}-primary_image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-12 mb-5">
                                                                            <h5>
                                                                                دیگر تصاویر:
                                                                            </h5>
                                                                        </div>
                                                                        @foreach($food->images as $image)
                                                                            <div class="col-md-3">
                                                                                <div class="card">
                                                                                    <img class="card-img-top" src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $image->image }}" alt="{{ $food->title }}-other_images">
                                                                                    <hr>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify" id="deleteFood-{{ $food->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $food->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این غذا اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.foods.destroy', ['food' => $food]) }}" method="POST">
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
                                    <div class="modal w-lg fade light blur" id="editFood-{{ $food->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $food->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateFood])
                                                    <form action="{{ route('admin.foods.update' , ['food' => $food->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="title">عنوان:*</label>
                                                                <input id="title" name="title" type="text" value="{{ $food->title }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="category_id">دسته بندی:*</label>
                                                                <select id="category_id" class="form-control" name="category_id">
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="ingredientSelect">ترکیبات:*</label>
                                                                <select id="ingredientSelect" class="form-control ingredientSelect" name="ingredient_ids[]" multiple data-live-search="true">
                                                                    @foreach($ingredients as $ingredient)
                                                                        <option value="{{ $ingredient->id }}"
                                                                            {{ in_array($ingredient->id , $food->ingredients()->pluck('id')->toArray() ) ? 'selected' : '' }}
                                                                        >{{ $ingredient->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="shop_id">رستوران:*</label>
                                                                <select id="shop_id" class="form-control" name="shop_id">
                                                                    <option value="{{ $shop->id }}" selected>{{ $shop->title }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="sku">شناسه انبار(sku):*</label>
                                                                <input id="sku" name="sku" type="text" value="{{ $food->sku }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="price">قیمت(به ریال):*</label>
                                                                <input id="price" name="price" type="text" value="{{ $food->price }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="1" {{ $food->getRawOriginal('status') == 1 ? 'selected' : '' }}>انتشار</option>
                                                                    <option value="0" {{ $food->getRawOriginal('status') == 0 ? 'selected' : '' }}>تعلیق</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-lg-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="is_vegan" name="is_vegan" {{ $food->getRawOriginal('is_vegan') == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="is_vegan">
                                                                        مناسب برای گیاهخواران
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="description">توضیحات:*</label>
                                                                <textarea id="description" type="text" name="description" class="form-control">{{ $food->description }}</textarea>
                                                            </div>
                                                            <div class="col-12 col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-header bg-primary">
                                                                        تخفیف
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-12 col-md-3">
                                                                                <label for="discounted_price">قیمت حراجی</label>
                                                                                <input id="discounted_price" type="text" name="discounted_price" value="{{ $food->discounted_price }}" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-3">
                                                                                <label for="discounted_quantity">تعداد حراجی</label>
                                                                                <input id="discounted_quantity" type="number" name="discounted_quantity" value="{{ $food->discounted_quantity }}" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-3">
                                                                                <label for="date_on_sale_from">تاریخ شروع حراجی</label>
                                                                                <input data-jdp name="date_on_sale_from" id="date_on_sale_from" value="{{ $food->date_on_sale_from === null ? null : verta($food->date_on_sale_from) }}" class="form-control text-left">
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-3">
                                                                                <label for="date_on_sale_to">تاریخ پایان حراجی</label>
                                                                                <input data-jdp name="date_on_sale_to" id="date_on_sale_to" value="{{ $food->date_on_sale_to === null ? null : verta($food->date_on_sale_to) }}" class="form-control text-left">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                            <div class="col-12 col-md-3 mb-5">
                                                                                <div class="card">
                                                                                    <img class="card-img-top" src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $food->primary_image }}" alt="{{ $food->title }}-primary_image">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-12 mb-5">
                                                                                <h5>
                                                                                    دیگر تصاویر:
                                                                                </h5>
                                                                            </div>
                                                                            @foreach($food->images as $image)
                                                                                <div class="col-md-3">
                                                                                    <div class="card">
                                                                                        <img class="card-img-top" src="{{ url(env('FOOD_IMAGE_UPLOAD_PATH')) . '/' . $image->image }}" alt="{{ $food->title }}-other_images">
                                                                                        <hr>
                                                                                        <div class="card-body text-center">
                                                                                            <form action="{{ route('admin.foods.images.destroy', ['food' => $food]) }}" method="POST">
                                                                                                @method('DELETE')
                                                                                                @csrf
                                                                                                <input type="hidden" name="image_id" value="{{{ $image->id }}}">
                                                                                                <input type="hidden" name="image_name" value="{{{ $image->image }}}">
                                                                                                <button class="btn btn-danger mb-3" type="submit">
                                                                                                    حذف
                                                                                                </button>
                                                                                            </form>
                                                                                            <form action="{{ route('admin.foods.images.set_primary', ['food' => $food->id]) }}" method="POST">
                                                                                                @method('PUT')
                                                                                                @csrf
                                                                                                <input type="hidden" name="image_id" value="{{{ $image->id }}}">
                                                                                                <button class="btn btn-info mb-3" type="submit">
                                                                                                    انتخاب بعنوان تصویر اصلی
                                                                                                </button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                    @if(count($errors->updateFood) > 0)
                                        <script>
                                            $('#editFood-{{ session()->get('food_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $foods->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        jalaliDatepicker.startWatch({ time: true });
        $('.ingredientSelect').selectpicker({
            'title' : 'انتخاب ماده'
        });
        $('#primary_image').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        $('#other_images').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        @if(count($errors->createFood) > 0)
            $(function() {
                $('#newFoodModal').modal({
                    show: true
                });
            });
        @endif
    </script>
@endsection
