@extends('home.layouts.profile.master')

@php
    $active = 'info';
@endphp

@section('profile_title', $user->email)

@section('profile_content')

    <div class="info-box p-4 m-2 h-100 w-100 row rounded" style="background-color: rgba(35,41,48,.1)">

        <form method="POST" action="{{ route('home.profile.update', ['user' => $user]) }}" class="w-100 row p-5" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-lg-6" style="display: flex;justify-content: center">
                <div class="profile-pic" style="max-width: fit-content;display: flex;justify-content: center;align-items: center">
                    <label class="-label" for="file">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span style="display: none;max-width: fit-content">تغییر پروفایل</span>
                    </label>
                    <input id="file" type="file" onchange="loadFile(event)" name="avatar"/>
                    <img src="{{ Str::contains($user->avatar, 'https://') ? $user->avatar : env('USER_AVATAR_UPLOAD_PATH') . '/' . $user->avatar }}" alt="{{ $user->username }}-image" id="output" width="200" />
                </div>
            </div>
            <div class="col-12 col-lg-6 text-right" style="direction: rtl">
                @include('sections.errors')
                <input type="hidden" value="{{ $user->id }}" name="user_id">
                <label for="username">نام کاربری:</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نام کاربری" id="username" value="{{ $user->username }}" name="username">
                </div>
                <label for="firstname">نام:(ترجیحا به فارسی)</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نام" id="firstname" value="{{ $user->firstname }}" name="firstname">
                </div>
                <label for="lastname">نام خانوادگی:(ترجیحا به فارسی)</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نام خانوادگی" id="lastname" value="{{ $user->lastname }}" name="lastname">
                </div>
                <label for="phone_number">شماره تلفن:</label>
                <div class="input-group mb-3">
                    <input type="tel" class="form-control" minlength="10" maxlength="10" placeholder="9121234567" id="phone_number" value="{{ $user->phone_number }}" name="phone_number">
                    <div class="input-group-append">
                        <span class="input-group-text">+98</span>
                    </div>
                </div>
                <label for="last_name">ایمیل:</label>
                @if($user->email_verified_at == null)
                    <i class="fa fa-times-circle text-danger">ایمیل شما تایید نشده!</i>
                @else
                    <i class="fa fa-check-circle text-success"></i>
                @endif
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="example@gmail.com" id="email" value="{{ $user->email }}" name="email">
                </div>
                <hr>
                <button class="btn btn-success w-100" type="submit">ثبت</button>
            </div>
        </form>
    </div>
@endsection
