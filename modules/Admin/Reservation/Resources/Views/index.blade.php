@extends('admin.layouts.master')
@section('title')
    رزرو ها
@endsection
@php
    $active_parent = 'reservations';
    $active_child = 'manageReservations';
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
                                        <span class="lite-text">رزرو ها</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">رزرو ها</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div>
                    @if($reservations->isEmpty())
                        <div class="alert alert-danger" style="margin: 5px">
                            رزروی یافت نشد!
                        </div>
                    @else
                        <table class="table text-center table-responsive-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رستوران</th>
                                <th scope="col">میز</th>
                                <th scope="col">مراسم</th>
                                <th scope="col">کاربر رزرو کننده</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $key => $reservation)
                                <tr>
                                    <th>
                                        {{ $reservations->firstItem() + $key }}
                                    </th>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/shopsSearch?keyword=' . $reservation->shop->title ) }}">
                                            {{ $reservation->shop->title }}
                                        </a>
                                    </td>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/tablesSearch?keyword=' . $reservation->table->title ) }}">
                                            {{ $reservation->table->title }}
                                        </a>
                                    </td>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/ceremoniesSearch?keyword=' . $reservation->ceremony->title ) }}">
                                            {{ $reservation->ceremony->title }}
                                        </a>
                                    </td>
                                    <td style="text-align: -webkit-center">
                                        <a class="text-center" href="{{ url('/management/usersSearch?keyword=' . $reservation->user->username ) }}">
                                            {{ $reservation->user->username }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge f-{{ $reservation->getRawOriginal('status') ?  'main' : 'warning' }}">
                                            {{ $reservation->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown base show" style="max-width: fit-content; margin: 0 auto">
                                            <a class="btn outlined o-light c-light f-white dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <button type="button" data-target="#showReservation-{{ $reservation->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    نمایش
                                                </button>
                                                <button type="button" data-target="#editReservation-{{ $reservation->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    ویرایش
                                                </button>
                                                <button type="button" data-target="#deleteReservation-{{ $reservation->id }}" data-toggle="modal" class="dropdown-item text-center">
                                                    حذف
                                                </button>
                                            </div>
                                        </div>
                                    </td>

                                    <div class="modal w-lg fade light blur" id="showReservation-{{ $reservation->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">نمایش: {{ $reservation->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="admin">رستوران:*</label>
                                                            <a href="{{ url('/management/shopsSearch?keyword=' . $reservation->shop->title ) }}">
                                                                {{ $reservation->shop->title }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="admin">میز:*</label>
                                                            <a href="{{ url('/management/tablesSearch?keyword=' . $reservation->table->title ) }}">
                                                                {{ $reservation->table->title }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="admin">مراسم:*</label>
                                                            <a href="{{ url('/management/ceremoniesSearch?keyword=' . $reservation->ceremony->title ) }}">
                                                                {{ $reservation->ceremony->title }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="admin">کاربر رزرو کننده:*</label>
                                                            <a href="{{ url('/management/usersSearch?keyword=' . $reservation->user->username ) }}">
                                                                {{ $reservation->user->username }}
                                                            </a>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="phone_number">شماره تلفن:*</label>
                                                            <input id="phone_number" type="tel" value="{{ $reservation->phone_number }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="paying_price">قیمت پرداختی:*</label>
                                                            <input id="paying_price" type="tel" value="{{ number_format($reservation->paying_price) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-4">
                                                            <label for="status">وضعیت:*</label>
                                                            <select class="form-control" id="status" disabled>
                                                                <option value="1" {{ $reservation->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                <option value="0" {{ $reservation->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="start_time">زمان شروع:*</label>
                                                            <input id="start_time" type="text" value="{{ $reservation->start_time }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="end_time">زمان پایان:*</label>
                                                            <input id="end_time" type="text" value="{{ $reservation->end_time }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="created_at">زمان ایجاد:*</label>
                                                            <input id="created_at" type="text" value="{{ verta($reservation->created_at) }}" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group col-12 col-lg-6">
                                                            <label for="updated_at">زمان ایجاد آخرین تغییر:*</label>
                                                            <input id="updated_at" type="text" value="{{ verta($reservation->updated_at) }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn outlined o-danger c-danger" data-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal w-lg fade justify " id="deleteReservation-{{ $reservation->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $reservation->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    آیا از حذف این رزرو اطمینان دارید؟
                                                </div>
                                                <form action="{{ route('admin.reservations.destroy', ['reservation' => $reservation]) }}" method="POST">
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
                                    <div class="modal w-lg fade light blur" id="editReservation-{{ $reservation->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content card shade">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $reservation->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('sections.errors', ['errors' => $errors->updateReservation])
                                                    <form action="{{ route('admin.reservations.update' , ['reservation' => $reservation->id]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row">
                                                            <div class="form-group col-12 col-lg-6">
                                                                <label for="status">وضعیت:*</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="1" {{ $reservation->getRawOriginal('status') == 1 ? 'selected' : '' }}>فعال</option>
                                                                    <option value="0" {{ $reservation->getRawOriginal('status') == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                </select>
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
                                    @if(count($errors->updateReservation) > 0)
                                        <script>
                                            $('#editReservation-{{ session()->get('reservation_id') }}').modal({
                                                show: true
                                            });
                                        </script>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $reservations->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
