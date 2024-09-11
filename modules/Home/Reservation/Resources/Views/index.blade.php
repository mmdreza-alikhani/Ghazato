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
            <form method="post" action="{{ route('home.shops.reservation.reserve', ['shop' => $shop->slug]) }}">
                @csrf
                <div class="form-inner rtl text-right">
                    <div class="col-12 col-md-4">
                        <label for="ceremony_id">مراسم:*</label>
                        <select id="ceremony_id" class="form-control" name="ceremony_id" required>
                            @foreach($ceremonies as $ceremony)
                                <option value="{{ $ceremony->id }}">{{ $ceremony->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-holder" style="direction: ltr">
                            <label for="date">تاریخ رزرو:*</label>
                            <input data-jdp data-jdp-min-date="today" id="dateSelect" name="date" class="form-control" placeholder="تاریخ رزرو" required>
                            <span class="lnr lnr-clock big primary-color" style="text-align: left!important;"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="tableSelect">میز:*</label>
                        <select id="tableSelect" class="form-control" name="table_id" required>
                        </select>
                    </div>
                    <div class="row col-12 col-md-6">
                        <label for="phone_number">شماره تلفن:*</label>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1">+98</span>
                        </div>
                        <input type="tel" id="phone_number" name="phone_number" class="form-control" minlength="10" maxlength="10" placeholder="شماره تلفن" required>
                    </div>
                    <div class="col-12 col-md-12">
                        <label for="description">توضیحات:*</label>
                        <textarea type="tel" id="description" name="description" class="form-control" placeholder="توضیحات" required></textarea>
                    </div>
                </div>
                <div class="btn-holder">
                    <button type="submit" class="au-btn round au-btn--hover has-bg">رزرو</button>
                </div>
            </form>
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
