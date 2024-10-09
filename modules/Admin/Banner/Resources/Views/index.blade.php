@extends('admin.layouts.master')
@section('title')
    بنر ها
@endsection
@php
    $active_parent = 'banners';
    $active_child = 'manageBanners';
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
                                        <span class="lite-text">بنر ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">بنر ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newBannerModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن بنر جدید
                        </button>
                        <a href="{{ route('admin.banners.trash') }}" class="btn btn-outline-secondary" style="max-width: fit-content">
                            <i class="fa fa-trash"></i>
                            سطل آشغال
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.banners.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین بنر ها با عنوان" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newBannerModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد بنر جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createBanner])
                                <form action="{{ route('admin.banners.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="title">عنوان:*</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="priority">اولویت*</label>
                                        <input type="number" name="priority" id="priority" class="form-control" value="{{ old('priority') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="1">فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="type">نوع بنر:*</label>
                                        <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-12">
                                        <label for="text">متن:*</label>
                                        <textarea type="text" name="text" id="text" class="form-control" required>{{ old('text') }}</textarea>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                افزودن دکمه
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-12 col-lg-4">
                                                        <label for="button_text">متن دکمه*</label>
                                                        <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text') }}" required>
                                                    </div>
                                                    <div class="form-group col-12 col-lg-4">
                                                        <label for="button_link">لینک دکمه*</label>
                                                        <input type="text" name="button_link" id="button_link" class="form-control" value="{{ old('button_link') }}" required>
                                                    </div>
                                                    <div class="form-group col-12 col-lg-4">
                                                        <label for="button_icon">آیکون دکمه*</label>
                                                        <input type="text" name="button_icon" id="button_icon" class="form-control" value="{{ old('button_icon') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                افزودن تصویر
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="custom-file col-12 m-1">
                                                        <input type="file" id="image" name="image" class="form-control custom-control-input" lang="fa" required>
                                                        <label for="image" class="custom-file-label text-left">تصویر</label>
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
                    @if($banners->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            بنری یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">اولویت</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">نوع بنر</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banners as $key => $banner)
                                <tr>
                                    <th>
                                        {{ $banners->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $banner->title }}
                                    </td>
                                    <td>
                                        {{ $banner->priority }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $banner->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $banner->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $banner->type }}
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showBanner-{{ $banner->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editBanner-{{ $banner->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteBanner-{{ $banner->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showBanner-{{ $banner->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $banner->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="title">عنوان:*</label>
                                                            <input type="text" id="title" class="form-control" value="{{ $banner->title }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="priority">اولویت*</label>
                                                            <input type="number" id="priority" class="form-control" value="{{ $banner->priority }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="1" {{ $banner->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                <option value="0" {{ $banner->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="type">نوع بنر:*</label>
                                                            <input type="text" id="type" class="form-control" value="{{ $banner->type }}" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-12">
                                                            <label for="text">متن:*</label>
                                                            <textarea type="text" id="text" class="form-control" disabled>{{ $banner->text }}</textarea>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mt-3">
                                                            <div class="card">
                                                                <div class="card-header bg-primary">
                                                                    افزودن دکمه
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="form-group col-12 col-lg-4">
                                                                            <label for="button_text">متن دکمه*</label>
                                                                            <input type="text" id="button_text" class="form-control" value="{{ $banner->button_text }}" disabled>
                                                                        </div>
                                                                        <div class="form-group col-12 col-lg-4">
                                                                            <label for="button_link">لینک دکمه*</label>
                                                                            <input type="text" id="button_link" class="form-control" value="{{ $banner->button_link }}" disabled>
                                                                        </div>
                                                                        <div class="form-group col-12 col-lg-4">
                                                                            <label for="button_icon">آیکون دکمه*</label>
                                                                            <input type="text" id="button_icon" class="form-control" value="{{ $banner->button_icon }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mt-3">
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
                                                                                <img class="card-img-top" src="{{ url(env('BANNER_IMAGE_UPLOAD_PATH')) . '/' . $banner->image }}" alt="{{ $banner->title }}-image">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($banner->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($banner->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify" id="deleteBanner-{{ $banner->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $banner->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این بنر اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.banners.destroy', ['banner' => $banner]) }}" method="POST">
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
                                    <div class="modal w-lg fade light blur" id="editBanner-{{ $banner->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $banner->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateBanner])
                                                    <form action="{{ route('admin.banners.update' , ['banner' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="title">عنوان:*</label>
                                                                <input type="text" name="title" id="title" class="form-control" value="{{ $banner->title }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="priority">اولویت*</label>
                                                                <input type="number" name="priority" id="priority" class="form-control" value="{{ $banner->priority }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status" required>
                                                                    <option value="1" {{ $banner->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                    <option value="0" {{ $banner->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="type">نوع بنر:*</label>
                                                                <input type="text" name="type" id="type" class="form-control" value="{{ $banner->type }}" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-12">
                                                                <label for="text">متن:*</label>
                                                                <textarea type="text" name="text" id="text" class="form-control" required>{{ $banner->text }}</textarea>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="card">
                                                                    <div class="card-header bg-primary">
                                                                        افزودن دکمه
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-12 col-lg-4">
                                                                                <label for="button_text">متن دکمه*</label>
                                                                                <input type="text" name="button_text" id="button_text" class="form-control" value="{{ $banner->button_text }}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-lg-4">
                                                                                <label for="button_link">لینک دکمه*</label>
                                                                                <input type="text" name="button_link" id="button_link" class="form-control" value="{{ $banner->button_link }}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-lg-4">
                                                                                <label for="button_icon">آیکون دکمه*</label>
                                                                                <input type="text" name="button_icon" id="button_icon" class="form-control" value="{{ $banner->button_icon }}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                                    <img class="card-img-top" src="{{ url(env('BANNER_IMAGE_UPLOAD_PATH')) . '/' . $banner->image }}" alt="{{ $banner->title }}-image">
                                                                                </div>
                                                                            </div>
                                                                            <div class="custom-file col-12 m-1">
                                                                                <input type="file" name="image" id="image_update" class="form-control custom-control-input" lang="fa">
                                                                                <label for="image_update" class="custom-file-label text-left">تصویر</label>
                                                                            </div>
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
                                    @if(count($errors->updateBanner) > 0)
                                        <script>
                                            $('#editBanner-{{ session()->get('banner_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $banners->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $('#image').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        $('#image_update').change(function() {
            const filename = $(this).val();
            $(this).next('.custom-file-label').html(filename)
        })
        @if(count($errors->createBanner) > 0)
            $(function() {
                $('#newBannerModal').modal({
                    show: true
                });
            });
        @endif
    </script>
@endsection
