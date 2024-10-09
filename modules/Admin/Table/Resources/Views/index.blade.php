@extends('admin.layouts.master')
@section('title')
    میز ها
@endsection
@php
    $active_parent = 'tables';
    $active_child = 'manageTables';
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
                                        <span class="lite-text">میز ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">میز ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newTableModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن میز جدید
                        </button>
                        <a href="{{ route('admin.tables.trash') }}" class="btn btn-outline-secondary" style="max-width: fit-content">
                            <i class="fa fa-trash"></i>
                            سطل آشغال
                        </a>
                    </div>
                    <div>
                        <form action="{{ route('admin.tables.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین میز ها" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newTableModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد میز جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createTable])
                                <form action="{{ route('admin.tables.store') }}" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="title">عنوان:*</label>
                                        <input id="title" name="title" type="text" value="{{ old('title') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="shop_id">رستوران:*</label>
                                        <select id="shop_id" class="form-control" name="shop_id">
                                            @foreach($shops as $shop)
                                                <option value="{{ $shop->id }}">{{ $shop->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="seats">تعداد صندلی:*</label>
                                        <input id="seats" name="seats" type="number" value="{{ old('seats') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="price">قیمت:*</label>
                                        <input id="price" name="price" type="text" value="{{ old('price') }}" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" selected>فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
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
                    @if($tables->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            میزی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tables as $key => $table)
                                <tr>
                                    <th>
                                        {{ $tables->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $table->title }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $table->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $table->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showTable-{{ $table->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editTable-{{ $table->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteTable-{{ $table->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade light blur" id="showTable-{{ $table->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $table->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="title">عنوان:*</label>
                                                            <input id="title" type="text" value="{{ $table->title }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="shop_id">رستوران:*</label>
                                                            <select id="shop_id" class="form-control" disabled>
                                                                @foreach($shops as $shop)
                                                                    <option value="{{ $shop->id }}" {{ $table->shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="seats">تعداد صندلی ها:*</label>
                                                            <input id="seats" type="number" value="{{ $table->seats }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="price">قیمت:*</label>
                                                            <input id="price" type="tel" value="{{ number_format($table->price) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="1" {{ $table->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                <option value="0" {{ $table->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($table->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($table->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify " id="deleteTable-{{ $table->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $table->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این میز اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.tables.destroy', ['table' => $table]) }}" method="POST">
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

                                    <div class="modal w-lg fade light blur" id="editTable-{{ $table->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $table->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateTable])
                                                    <form action="{{ route('admin.tables.update' , ['table' => $table->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="title">عنوان:*</label>
                                                                <input id="title" name="title" type="text" value="{{ $table->title }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="shop_id">رستوران:*</label>
                                                                <select id="shop_id" class="form-control" name="shop_id">
                                                                    @foreach($shops as $shop)
                                                                        <option value="{{ $shop->id }}" {{ $table->shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="seats">تعداد صندلی ها:*</label>
                                                                <input id="seats" name="seats" type="number" value="{{ $table->seats }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="price">قیمت:*</label>
                                                                <input id="price" name="price" type="text" value="{{ $table->price }}" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="1" {{ $table->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                    <option value="0" {{ $table->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                </select>
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
                                    @if(count($errors->updateTable) > 0)
                                        <script>
                                            $('#editTable-{{ session()->get('table_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tables->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        @if(count($errors->createTable) > 0)
        $(function() {
            $('#newTableModal').modal({
                show: true
            });
        });
        @endif
    </script>
@endsection
