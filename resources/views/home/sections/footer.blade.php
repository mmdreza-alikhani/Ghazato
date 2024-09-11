@php
    $setting = \App\Models\Setting::first();
@endphp
<footer>
    <!-- FOOTER TOP -->
    <div class="ft-top">
        <div class="container">
            <div class="ft-top-wrapper">
                <div class="ft-logo">
                    <a href="{{ route('home.index') }}">
                        <img src="/home/images/logo.png" alt="">
                    </a>
                </div>
                <div class="row justify-content-between justify-content-xl-start">
                    <div class="col-md-3  ft-col">
                        <h6>درباره ما</h6>
                        <p>{{ $setting->about }}</p>
                    </div>
                    <div class="col-md-5  col-xl-4 offset-xl-1 ft-col rtl text-center">
                        <h6 id="feedback">بیان انتقادات و نظرات:</h6>
                        <div class="form-inner">
                            <button type="button" data-target="#newFeedbackModal" data-toggle="modal" class="au-btn round au-btn--hover has-bg">
                                <span class="lnr lnr-envelope"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-2  ml-xl-auto ft-col">
                        <h6>ارتباط با من</h6>
                        <a href="tel:{{ $setting->phone_number }}">{{ $setting->phone_number }}</a>
                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                        <div class="social">
                            <a href="{{ $setting->linkedin }}">
                                <i class="zmdi zmdi-linkedin"></i>
                            </a>
                            <a href="{{ $setting->github }}">
                                <i class="zmdi zmdi-github"></i>
                            </a>
                            <a href="{{ $setting->instagram }}">
                                <i class="zmdi zmdi-instagram"></i>
                            </a>
                            <a href="{{ $setting->telegram }}">
                                <i class="zmdi zmdi-mail-send"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ft-bot">
        <div class="container">
            @ 2024 Ghazato.
        </div>
    </div>
</footer>
<div class="modal fade" id="newFeedbackModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header rtl text-right">
                <h5 class="modal-title" id="exampleModalLabel">بیان انتقاد:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body rtl text-right">
                @include('sections.errors', ['errors' => $errors->createFeedback])
                <form action="{{ route('home.receiveFeedback') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject">موضوع:*</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="text">متن:*</label>
                        <textarea class="form-control" id="text" name="text" rows="5" required>{{ old('text') }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                <button type="submit" class="btn btn-outline-info">ارسال</button>
            </div>
            </form>
        </div>
    </div>
</div>
