@extends('admin.layouts.master')
@section('title')
    دسته بندی ها
@endsection
@php
    $active_parent = 'categories';
    $active_child = 'manageCategories';
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
                                        <span class="lite-text">دسته بندی ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">دسته بندی ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newCategoryModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن دسته بندی جدید
                        </button>
                        <a href="{{ route('admin.categories.trash') }}" class="btn btn-outline-secondary" style="max-width: fit-content">
                            <i class="fa fa-trash"></i>
                            سطل آشغال
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.categories.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین دسته بندی ها با عنوان" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newCategoryModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد دسته بندی جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createCategory])
                                <form action="{{ route('admin.categories.store') }}" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="title">عنوان:*</label>
                                        <input id="title" name="title" type="text" value="{{ old('title') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="1" selected>فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="icon">آیکون:*</label>
                                        <input id="icon" name="icon" type="text" value="{{ old('icon') }}" class="form-control" required>
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
                    @if($categories->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            دسته بندی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">آیکون</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <th>
                                        {{ $categories->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $category->title }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $category->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $category->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $category->icon }}
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#editCategory-{{ $category->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteCategory-{{ $category->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade justify " id="deleteCategory-{{ $category->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $category->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این دسته بندی اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="POST">
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

                                    <div class="modal w-lg fade light blur" id="editCategory-{{ $category->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $category->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateCategory])
                                                    <form action="{{ route('admin.categories.update' , ['category' => $category->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="title">عنوان:*</label>
                                                                <input id="title" name="title" type="text" value="{{ $category->title }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status" required>
                                                                    <option value="1" {{ $category->getRawOriginal('status') ? 'selected' : '' }} >فعال</option>
                                                                    <option value="0" {{ $category->getRawOriginal('status') ? '' : 'selected' }} >غیرفعال</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="icon">آیکون:*</label>
                                                                <input id="icon" name="icon" type="text" value="{{ $category->icon }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="created_at">زمان ایجاد:*</label>
                                                                <input id="created_at" type="text" value="{{ verta($category->created_at) }}" class="form-control" disabled>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                                <input id="updated_at" type="text" value="{{ verta($category->updated_at) }}" class="form-control" disabled>
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
                                    @if(count($errors->updateCategory) > 0)
                                        <script>
                                            $('#editCategory-{{ session()->get('category_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        @if(count($errors->createCategory) > 0)
            $(function() {
                $('#newCategoryModal').modal({
                    show: true
                });
            });
       @endif
    </script>
@endsection
