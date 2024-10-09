@extends('home.layouts.master')

@section('title')
    {{ $shop->title }}
@endsection
@section('content')
    <!-- PAGE INFO -->
    <section class="page-info set-bg" data-bg="/home/images/page-info-bg-2.jpg">
        <div class="section-header">
            <h1 class="text-white">رزرو</h1>
            <span>~ {{ $shop->title }} ~</span>
        </div>
    </section>

    <!-- FORM -->
    <section class="section-primary section-form pb-120">
        <div class="container">
            <div class="section-header">
                <h2>یک میز را رزرو کنید</h2>
                <span>~ بهترین جا برای شما ~</span>
            </div>
            <form class="rtl text-right" method="post" action="{{ route('home.shops.reservation.reserve', ['shop' => $shop->slug]) }}">
                <input type="hidden" name="shop_id" value="{{ $shop->id }}" required>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}" required>
                @csrf
                @include('sections.errors', ['errors' => $errors->createReservation])
                <div class="form-inner form-group rtl text-right row">
                    <div class="col-12 col-md-6 p-4">
                        <label for="ceremony_id">مراسم:*</label>
                        <select id="ceremony_id" class="form-control" name="ceremony_id" required>
                            @foreach($ceremonies as $ceremony)
                                <option value="{{ $ceremony->id }}">{{ $ceremony->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 p-4">
                        <div class="form-holder" style="direction: ltr">
                            <label for="date">تاریخ رزرو:*</label>
                            <input data-jdp data-jdp-min-date="today" id="dateSelect" name="date" class="form-control" placeholder="تاریخ رزرو" required>
                            <span class="lnr lnr-clock big primary-color" style="text-align: left!important;"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-4">
                        <label for="tableSelect">میز:*</label>
                        <select id="tableSelect" class="form-control" name="table_id" required>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 p-4">
                        <label for="phone_number">شماره تلفن:*(98+)</label>
                        <input type="tel" id="phone_number" name="phone_number" class="form-control" minlength="10" maxlength="10" placeholder="شماره تلفن" required>
                    </div>
                    <div class="col-12 col-md-12 p-4">
                        <label for="description">توضیحات:*</label>
                        <textarea type="tel" id="description" name="description" class="form-control" placeholder="توضیحات" required></textarea>
                    </div>
                </div>
                <div class="btn-holder">
                    <button type="submit" class="au-btn round au-btn--hover has-bg">رزرو</button>
                </div>
            </form>
            <div class="info mt-5">
                <div class="row justify-content-between">
                    <div class="col-md-4 col-xl-3">
                        <div class="opening-col">
                            <h5>Opening hours</h5>
                            <p>
                                <span>Monday - Saturday</span>
                                7am - 10pm
                            </p>
                            <p>
                                <span>Sunday</span>
                                9am - 8pm
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-xl-7">
                        <div class="support">
                            <h5>Reservations support</h5>
                            <div class="row">
                                <div class="col-xl-6">
                                    <p class="address">
                                        <span>Addres:</span>
                                        40 Maria Street 133/2 New York
                                    </p>
                                    <p class="phone">
                                        <a href="tel:+15618003666666">
                                            <span>Phone:</span>
                                            + (156) 1800-366-6666
                                        </a>
                                    </p>

                                </div>
                                <div class="col-xl-6">
                                    <p class="email">
                                        <a href="#">
                                            <span>Email:</span>
                                            Eric-82@example.com
                                        </a>
                                    </p>
                                    <p class="website">
                                        <a href="#">
                                            <span>Website:</span>
                                            www.royate.com
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="social">
                            <a href="#">
                                <i class="zmdi zmdi-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-facebook-box"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-linkedin"></i>
                            </a>
                            <a href="#">
                                <i class="zmdi zmdi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        jalaliDatepicker.startWatch({});
        $('#dateSelect').change(function() {

            $("#tableSelect").empty()
            const date = $(this).val();

            if (date) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get_available_shop_tables_list') }}?shop_id=" + {{ $shop->id }} + "&date=" + date,
                    success: function(res) {
                        if (res) {
                            $("#tableSelect").empty();

                            $.each(res, function(key , table) {
                                $("#tableSelect").append('<option value="' + table.id + '">' +
                                    table.title + '</option>');
                            });

                        } else {
                            $("#tableSelect").empty();
                        }
                    }
                });
            } else {
                $("#tableSelect").empty();
            }
        });
    </script>
@endsection
