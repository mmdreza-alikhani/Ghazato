@extends('admin.layouts.master')
@section('title')
    ترکیبات
@endsection
@php
    $active_parent = 'ingredients';
    $active_child = 'manageIngredients';
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
                                        <span class="lite-text">ترکیبات</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">ترکیبات</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newIngredientModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن ترکیب جدید
                        </button>
                    </div>
                    <div>
                        <form action="{{ route('admin.ingredients.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین ترکیبات" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newIngredientModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد ترکیب جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createIngredient])
                                <form action="{{ route('admin.ingredients.store') }}" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="title">عنوان:*</label>
                                        <input id="title" name="title" type="text" value="{{ old('title') }}" class="form-control" required>
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
                    @if($ingredients->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            ترکیبی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ingredients as $key => $ingredient)
                                <tr>
                                    <th>
                                        {{ $ingredients->firstItem() + $key }}
                                    </th>
                                    <td>
                                        {{ $ingredient->title }}
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#editIngredient-{{ $ingredient->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteIngredient-{{ $ingredient->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade justify " id="deleteIngredient-{{ $ingredient->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $ingredient->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این ترکیب اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.ingredients.destroy', ['ingredient' => $ingredient]) }}" method="POST">
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

                                    <div class="modal w-lg fade light blur" id="editIngredient-{{ $ingredient->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $ingredient->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateIngredient])
                                                    <form action="{{ route('admin.ingredients.update' , ['ingredient' => $ingredient->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-4">
                                                                <label for="title">عنوان:*</label>
                                                                <input id="title" name="title" type="text" value="{{ $ingredient->title }}" class="form-control" required>
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
                                    @if(count($errors->updateIngredient) > 0)
                                        <script>
                                            $('#editIngredient-{{ session()->get('ingredient_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $ingredients->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        @if(count($errors->createIngredient) > 0)
            $(function() {
                $('#newIngredientModal').modal({
                    show: true
                });
            });
       @endif
    </script>
@endsection
