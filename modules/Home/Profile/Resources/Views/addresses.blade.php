@extends('home.layouts.profile.master')

@php
    $active = 'addresses';
@endphp

@section('profile_title', $user->email)

@section('profile_content')
    <div class="info-box p-4 m-2 row rounded" style="background-color: rgba(35,41,48,.1)">
        <h4 class="rtl text-right">آدرس های شما:</h4>
        <button type="button" data-target="#newAddressModal" data-toggle="modal" class="btn btn-outline-primary" style="max-width: fit-content">
            <i class="fa fa-plus"></i>
            افزودن آدرس جدید
        </button>
        <div class="modal w-lg fade light blur" id="newAddressModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content card shade">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد آدرس جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('sections.errors', ['errors' => $errors->createAddress])
                        <form action="{{ route('home.profile.addresses.store') }}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-12 col-lg-12">
                                <label for="title">عنوان:*</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="postal_code">کد پستی:*</label>
                                <input type="number" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="phone_number">شماره تلفن:*</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="provinceSelect">استان:*</label>
                                <div class="input-group mb-3">
                                    <select id="provinceSelect" class="form-control" name="province_id">
                                        <option value="0" selected disabled>استان خود را انتخاب کنید...</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == old('province_id') ? 'selected' : '' }}>{{ $province->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="citySelect">شهر:*</label>
                                <div class="input-group mb-3">
                                    <select id="citySelect" class="form-control" name="city_id">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $city->id == old('city_id') ? 'selected' : '' }}>{{ $city->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12 col-lg-12">
                                <label for="address">متن:*</label>
                                <textarea type="text" name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
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
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">عنوان</th>
                <th scope="col">شماره تلفن</th>
                <th scope="col">تنظیمات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->title }}</td>
                    <td>{{ $address->phone_number }}</td>
                    <td>
                    <button type="button" data-target="#editAddress-{{ $address->id }}" data-toggle="modal" class="dropdown-item text-center">
                        ویرایش
                    </button>
                    <button type="button" data-target="#deleteAddress-{{ $address->id }}" data-toggle="modal" class="dropdown-item text-center">
                        حذف
                    </button>
                    </td>
                    <div class="modal w-lg fade justify" id="deleteAddress-{{ $address->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف: {{ $address->title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    آیا از حذف این آدرس اطمینان دارید؟
                                </div>
                                <form action="{{ route('home.profile.addresses.destroy', ['user_address' => $address]) }}" method="POST">
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
                    <div class="modal w-lg fade light blur" id="editAddress-{{ $address->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content card shade">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ویرایش: {{ $address->title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('sections.errors', ['errors' => $errors->updateAddress])
                                    <form action="{{ route('home.profile.addresses.update' , ['user_address' => $address->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="form-group col-12 col-lg-12">
                                                <label for="title">عنوان:*</label>
                                                <input type="text" name="title" id="title" class="form-control" value="{{ $address->title }}" required>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="postal_code">کد پستی:*</label>
                                                <input type="number" name="postal_code" id="postal_code" class="form-control" value="{{ $address->postal_code }}" required>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="phone_number">شماره تلفن:*</label>
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $address->phone_number }}" required>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="provinceSelect">استان:*</label>
                                                <div class="input-group mb-3">
                                                    <select id="provinceSelect" class="form-control" name="province_id">
                                                        <option value="0" selected disabled>استان خود را انتخاب کنید...</option>
                                                        @foreach($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ $province->id == $address->province_id ? 'selected' : '' }}>{{ $province->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="citySelect">شهر:*</label>
                                                <div class="input-group mb-3">
                                                    <select id="citySelect" class="form-control" name="city_id">
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}" {{ $city->id == $address->city_id ? 'selected' : '' }}>{{ $city->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-lg-12">
                                                <label for="address">متن:*</label>
                                                <textarea type="text" name="address" id="address" class="form-control" required>{{ $address->address }}</textarea>
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
                    @if(count($errors->updateAddress) > 0)
                        <script>
                            $('#editAddress-{{ session()->get('address_id') }}').modal({
                                show: true
                            });
                        </script>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $('#provinceSelect').change(function() {

            var provinceID = $(this).val();

            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get_province_cities_list') }}?province_id=" + provinceID,
                    success: function(res) {
                        console.log(res)
                        if (res) {
                            $("#citySelect").empty();

                            $.each(res, function(key , city) {
                                $("#citySelect").append('<option value="' + city.id + '">' +
                                    city.title + '</option>');
                            });

                        } else {
                            $("#citySelect").empty();
                        }
                    }
                });
            } else {
                $("#citySelect").empty();
            }
        });
        @if(count($errors->createAddress) > 0)
        $(function() {
            $('#newAddressModal').modal({
                show: true
            });
        });
        @endif
    </script>
@endsection
