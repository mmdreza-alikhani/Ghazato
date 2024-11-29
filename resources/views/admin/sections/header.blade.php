<header class="bmd-layout-header ">
    <div class="navbar navbar-light bg-faded animate__animated animate__fadeInDown">
        <button class="navbar-toggler animate__animated animate__wobble animate__delay-2s" type="button" data-toggle="drawer" data-target="#dw-s1">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
            $unansweredFeedbacks = \App\Models\Feedback::unanswered()->get();
        @endphp
        <ul class="nav navbar-nav p-0">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn dropdown-toggle m-0" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-envelope fa-lg"></i><span class="badge badge-pill badge-danger animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s">{{ $unansweredFeedbacks->count() }}</span>
                    </button>
                    <div aria-labelledby="dropdownMenu2" class="dropdown-menu dropdown-menu-right dropdown-menu dropdown-menu-right-lg">
                        @if($unansweredFeedbacks->isEmpty())
                            <div class="alert">هیچ پیام جدیدی در دسترس نیست:)</div>
                        @else
                            @foreach($unansweredFeedbacks as $unansweredFeedback)
                                <span class="dropdown-item dropdown-header">{{ $unansweredFeedbacks->count() }} پیام</span>
                                <div class="dropdown-divider"></div>
                                    <a href="{{ url('/management/feedbackSearch?keyword=' . $unansweredFeedback->subject ) }}" class="dropdown-item">
                                        <i class="far fa-envelope c-main mr-2"></i>{{ $unansweredFeedback->subject }}
                                        <span class="float-right-rtl text-muted text-sm">{{ $unansweredFeedback->updated_at->diffForHumans() }}</span>
                                    </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.feedback.index') }}" class="dropdown-item dropdown-footer">دیدن همه</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item"> <img src="{{ asset('assets/admin/img/user-profile.jpg') }}" alt="..." class="rounded-circle screen-user-profile"></li>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn  dropdown-toggle m-0" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        مجید
                    </button>
                    <div class="dropdown-menu  pl-3 dropdown-menu-right dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button"><i class="far fa-user c-main fa-sm mr-2"></i>پروفایل</button>
                        <button onclick="dark()" class="dropdown-item" type="button"><i class="fas fa-moon fa-sm c-main mr-2"></i>حالت شب</button>
                        <button class="dropdown-item" type="button"><i class="fas fa-cog c-main fa-sm mr-2"></i>تنظیمات</button>
                        <button class="dropdown-item" type="button"><i class="fas fa-sign-out-alt c-main fa-sm mr-2"></i>خروج</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
