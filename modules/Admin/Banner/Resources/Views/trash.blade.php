@extends('admin.layouts.master')
@section('title')
    بنر ها: (سطل آشغال)
@endsection
@php
    $active_parent = 'banners';
    $active_child = 'manageDeletedBanners';
@endphp
@section('content')
    <main class="bmd-layout-content">
        <div class="container-fluid">
            <div class="row m-1 pb-4 mb-3">
                <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 p-2">
                    <div class="page-header breadcrumb-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title text-left-rtl">
                                    <div class="d-inline">
                                        <h3 class="lite-text">پنل مدیریت</h3>
                                        <span class="lite-text">بنر ها: (سطل آشغال)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">بنر ها</a></li>
                                    <li class="breadcrumb-item active">بنر  ها: (سطل آشغال)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <a href="{{ route('admin.banners.index') }}" type="button" class="btn btn-outline-primary" style="max-width: fit-content">
                            بازگشت
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.banners.searchFromTrash') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین بنر های حذف شده با عنوان" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
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
                                                <button type="button" data-target="#restoreBanner-{{ $banner->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    بازگردانی
                                                </button>
                                                <button type="button" data-target="#fullyDeleteBanner-{{ $banner->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف کامل
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade justify " id="fullyDeleteBanner-{{ $banner->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف کامل: {{ $banner->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف کامل این بنر اطمینان دارید؟
                                                    (این عمل بازگشت ناپذیر است!)
                                                </div>
                                                <form action="{{ route('admin.banners.forceDelete', ['banner' => $banner]) }}" method="POST">
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

                                    <div class="modal w-lg fade justify " id="restoreBanner-{{ $banner->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">بازگردانی: {{ $banner->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از بازگردانی این بنر اطمینان دارید؟
                                                    (این عمل بازگشت پذیر است!)
                                                </div>
                                                <form action="{{ route('admin.banners.restore', ['banner' => $banner]) }}" method="POST">
                                                    <div class="modal-footer">
                                                        @csrf
                                                        <button type="button" class="btn outlined o-main c-main" data-dismiss="modal">بازگشت</button>
                                                        <button type="submit" class="btn outlined f-success">بازگردانی</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
