@extends('admin.layouts.master')
@section('title')
    تنظیمات
@endsection
@php
    $active_parent = 'settings';
    $active_child = 'manageSettings';
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
                                        <span class="lite-text">تنظیمات</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active">تنظیمات</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron shade pt-5">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            تنظیمات
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="address">آدرس:*</label>
                                    <input type="text" id="address" class="form-control" value="{{ $setting->address }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="telephone">تلفن اول:*</label>
                                    <input type="tel" id="telephone" class="form-control" value="{{ $setting->telephone }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="telephone2">تلفن دوم:*</label>
                                    <input type="tel" id="telephone2" class="form-control" value="{{ $setting->telephone2 }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="instagram">اینستاگرام:*</label>
                                    <input type="text" id="instagram" class="form-control" value="{{ $setting->instagram }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="telegram">تلگرام:*</label>
                                    <input type="text" id="telegram" class="form-control" value="{{ $setting->telegram }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="github">گیت هاب:*</label>
                                    <input type="text" id="github" class="form-control" value="{{ $setting->github }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="linkedin">لینکدین:*</label>
                                    <input type="text" id="linkedin" class="form-control" value="{{ $setting->linkedin }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="delivery_amount">هزینه ارسال:*</label>
                                    <input type="tel" id="delivery_amount" class="form-control" value="{{ $setting->delivery_amount }}" disabled>
                                </div>
                                <div class="form-group col-12 col-lg-12">
                                    <label for="about">درباره من:*</label>
                                    <textarea type="text" id="about" class="form-control" disabled>{{ $setting->about }}</textarea>
                                </div>
                            </div>
                            <button type="button" data-target="#editSettings-{{ $setting->id }}" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
                                <i class="fa fa-edit"></i>
                                ویرایش
                            </button>
                        </div>
                    </div>
                </div>

                    <div class="modal w-lg fade light blur" id="editSettings-{{ $setting->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content card shade">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش تنظبمات: </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('sections.errors', ['errors' => $errors->updateSetting])
                                    <form action="{{ route('admin.settings.update' , ['setting' => $setting->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="address">آدرس:*</label>
                                                <input type="text" id="address" name="address" class="form-control" value="{{ $setting->address }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="telephone">تلفن اول:*</label>
                                                <input type="tel" id="telephone" name="telephone" class="form-control" value="{{ $setting->telephone }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="telephone2">تلفن دوم:*</label>
                                                <input type="tel" id="telephone2" name="telephone2" class="form-control" value="{{ $setting->telephone2 }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="instagram">اینستاگرام:*</label>
                                                <input type="text" id="instagram" name="instagram" class="form-control" value="{{ $setting->instagram }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="telegram">تلگرام:*</label>
                                                <input type="text" id="telegram" name="telegram" class="form-control" value="{{ $setting->telegram }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="github">گیت هاب:*</label>
                                                <input type="text" id="github" name="github" class="form-control" value="{{ $setting->github }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="linkedin">لینکدین:*</label>
                                                <input type="text" id="linkedin" name="linkedin" class="form-control" value="{{ $setting->linkedin }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="delivery_amount">هزینه ارسال:*</label>
                                                <input type="tel" id="delivery_amount" name="delivery_amount" class="form-control" value="{{ $setting->delivery_amount }}">
                                            </div>
                                            <div class="form-group col-12 col-lg-12">
                                                <label for="about">درباره من:*</label>
                                                <textarea type="text" name="about" id="about" class="form-control">{{ $setting->about }}</textarea>
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
                    @if(count($errors->updateSetting) > 0)
                        <script>
                            $('#editSettings-{{ session()->get('setting_id') }}').modal({
                                show: true
                            });
                        </script>
                    @endif
            </div>
        </div>
    </main>
@endsection
