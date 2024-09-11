@extends('admin.layouts.master')
@section('title')
    کاربران
@endsection
@php
    $active_parent = 'users';
    $active_child = 'manageUsers';
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
                                        <span class="lite-text">کاربران</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">کاربران</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="row mx-1">
                    <div>
                        <button type="button" data-target="#newUserModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                            <i class="fa fa-plus"></i>
                            افزودن کاربر جدید
                        </button>
                    </div>
                    <div>
                        <form action="{{ route('admin.users.search') }}" method="GET">
                            <input type="text" class="form-control" placeholder="جستجو بین کاربران با نام کاربری" style="width: 250px" value="{{ request()->has('keyword') ? request()->keyword : '' }}" name="keyword">
                            <button type="submit" class="d-none"></button>
                        </form>
                    </div>
                </div>

                <div class="modal w-lg fade light blur" id="newUserModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content card shade">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ایجاد کاربر جدید</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('sections.errors', ['errors' => $errors->createUser])
                                <form action="{{ route('admin.users.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="username">نام کاربری*</label>
                                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="firstname">نام:</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="lastname">نام خانوادگی:</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="email">ایمیل:*</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="password">رمز عبور:*</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="password_confirmation">تکرار رمز عبور:*</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="phone_number">شماره تلفن:</label>
                                        <div class="input-group-prepend">
                                            <input type="tel" name="phone_number" id="phone_number" minlength="10" maxlength="10" class="form-control" value="{{ old('phone_number') }}">
                                            <div class="input-group-text">98+</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-lg-4">
                                        <label for="status">وضعیت:*</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" selected>انتشار</option>
                                            <option value="0">تعلیق</option>
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
                    @if($users->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            کاربری یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">آواتار</th>
                                <th scope="col">نام کاربری</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <th>
                                        {{ $users->firstItem() + $key }}
                                    </th>
                                    <td>
                                        <img src="{{ Str::contains($user->avatar, 'https://') ? $user->avatar : env('USER_AVATAR_UPLOAD_PATH') . '/' . $user->avatar }}" alt="{{ $user->username }}-avatar" id="output" width="100" height="100" />
                                    </td>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $user->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{$user->status}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showUser-{{ $user->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editUser-{{ $user->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteUser-{{ $user->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <div class="modal w-lg fade light blur" id="showUser-{{ $user->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $user->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify" id="deleteUser-{{ $user->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $user->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این کاربر اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" method="POST">
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
                                    <div class="modal w-lg fade light blur" id="editUser-{{ $user->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $user->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateUser])
                                                    <form action="{{ route('admin.users.update' , ['user' => $user->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
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
                                    @if(count($errors->updateUser) > 0)
                                        <script>
                                            $('#editUser-{{ session()->get('user_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
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
        @if(count($errors->createUser) > 0)
            $(function() {
                $('#newUserModal').modal({
                    show: true
                });
            });
        @endif
    </script>
@endsection
