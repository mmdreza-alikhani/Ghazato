@extends('home.layouts.master')

@section('title', 'صفحه اصلی')

@php
    $active = 'home';
@endphp

@section('content')
    <!-- SLIDE SHOW -->
    <div class="rev_slider_wrapper">
        <div id="rev_slider_3" class="rev_slider" data-version="5.4.5">
            <ul>
                @foreach($banners as $banner)
                    <li data-transition="">
                        <img src="{{ url(env('BANNER_IMAGE_UPLOAD_PATH')) . '/' . $banner->image }}" class="rev-slidebg" alt="{{ $banner->title . '-image' }}">

                        <div class="tp-caption tp-resizeme caption-4"
                             data-frames='[{"delay":2500,"speed":2000,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-x="center"
                             data-y="middle"
                             data-fontsize="['67', '67', '67', '67', '67']"
                             data-voffset="['-42','12', '26', '-18', '-28']"
                             data-lineheight="inherit"
                             data-color="#fff"
                        >
                            {{ $banner->title }}
                        </div>

                        <div class="tp-caption tp-resizeme caption-5"
                             data-frames='[{"delay":3000,"speed":2000,"frame":"0","from":"x:{-250,250};y:{-150,150};rX:{-90,90};rY:{-90,90};rZ:{-360,360};sX:0;sY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-x="center"
                             data-y="middle"
                             data-fontsize="['27', '27', '27', '27', '45']"
                             data-voffset="['54','108', '122', '78', '68']"
                             data-lineheight="inherit"
                             data-color="#ffcc66"
                        >
                            <p class="text-center w-md">{{ $banner->text }}</p>
                        </div>

                        <div class="tp-caption tp-resizeme caption-form" style="display: flex;justify-content: center"
                             data-frames='[{"delay":1000,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-x="center"
                             data-y="bottom"
                             data-voffset="['143','93', '73', '78', '73']"
                             data-lineheight="inherit"
                             data-width="['991', '991', '891', '991', '991']"
                             data-visibility='["on", "on", "on", "on", "on"]'
                        >
                            <a href="{{ $banner->button_link }}" class="btn btn-info" data-fontsize="['18', '18', '18', '18', '18']">{{ $banner->button_text }}</a>
                        </div>

                        <div class="tp-caption tp-resizeme caption-pointer"
                             data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-x="left"
                             data-y="middle"
                             data-fontsize="['25', '25', '25', '30', '50']"
                             data-hoffset="['80','40', '40', '40', '20']"
                             data-lineheight="inherit"
                             data-color="#fff"
                             data-visibility='["on", "on", "on", "on", "off"]'
                             data-actions='[{
								"event": "click",
								"action": "jumptoslide",
								"slide": "previous",
								"delay": "0"
							}]'
                        >
                            <span class="lnr lnr-arrow-left"></span>
                        </div>

                        <div class="tp-caption tp-resizeme caption-pointer"
                             data-frames='[{"delay":0,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-x="right"
                             data-y="middle"
                             data-fontsize="['25', '25', '25', '30', '50']"
                             data-hoffset="['80','40', '40', '40', '20']"
                             data-lineheight="inherit"
                             data-color="#fff"
                             data-visibility='["on", "on", "on", "on", "off"]'
                             data-actions='[{
								"event": "click",
								"action": "jumptoslide",
								"slide": "next",
								"delay": "0"
							}]'
                        >
                            <span class="lnr lnr-arrow-right"></span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- WELCOME TO ROYATE -->
    <section class="welcome section-primary pt-150 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="place-holder-1">
                                    <img src="/home/images/welcome-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 ml--10">
                                <div class="place-holder-2">
                                    <img src="/home/images/welcome-2.jpg" alt="">
                                </div>
                                <img src="/home/images/welcome-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="welcome-content">
                        <div class="section-header text-r\">
                            <h2>به غذاتو خوش آمدید</h2>
                            <span>~ کیفیت و زیبایی ~</span>
                        </div>
                        <div class="body text-center rtl">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                            <a class="au-btn__readmore" href="about-us.html">بیشتر بخوانید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRAIT -->
    <section class="trait">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-xl-6 px-0 mx-auto">
                    <div class="image-holder">
                        <img src="/home/images/trait.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 px-0">
                    <div class="trait-content">
                        <div class="trait-col">
                            <img src="/home/images/serve-icon.png" alt="">
                            <h5 style="font-family: Vazir-ExtraBold">رزرو</h5>
                            <p>امکان رزرو میز های چند نفره برای مجالس شما</p>
                        </div>
                        <div class="trait-col mr-0">
                            <img src="/home/images/hot-food-icon.png" alt="">
                            <h5>رستوران های مختلف</h5>
                            <p>امکان سفارش از رستوران های مختلف</p>
                        </div>
                        <div class="trait-col mb-md-0">
                            <img src="/home/images/fresh-food-icon.png" alt="">
                            <h5>غذای تازه</h5>
                            <p>استفاده از ترکیبات تازه و مناسب</p>
                        </div>
                        <div class="trait-col mb-0 mr-0">
                            <img src="/home/images/coffee-icon.png" alt="">
                            <h5>نوشیدنی</h5>
                            <p>دریافت نوشیدنی های گرم و سرد</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR STORY -->
    <section class="our-story">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-xl-6 px-0 order-2 order-lg-1">
                    <div class="our-story-primary style-1">
                        <div class="inner">
                            <div class="heading">
                                <h2>Our Story</h2>
                                <img src="/home/images/border.png" alt="">
                            </div>
                            <div class="body">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
                                <div class="end">
                                    <img src="/home/images/signature.png" alt="">
                                    <div class="name">
                                        <h6>
                                            <a href="#">Harry Price</a>
                                        </h6>
                                        <span>Restaurant Owners</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 px-0 order-1 order-lg-2">
                    <div class="image-holder">
                        <img src="/home/images/our-story.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-menu section-primary pb-113">
        <div class="container">
            <div class="section-header">
                <h2 class="text-white">محبوب ترینها</h2>
                <span>~ ببین چی داریم ~</span>
            </div>
            <div class="row justify-content-between rtl">
                @foreach($categories as $category)
                    <div class="col-md-6">
                        <div class="our-menu-col {{ $loop->iteration / 2 != 0 ? 'left' : 'right'}}">
                            <div class="heading">
                                <h3 style="float: right">{{ $category->title }}</h3>
                                <span class="icon">
                                    <img src="/home/images/{{ $category->icon}}" alt="{{ $category->title . '-image' }}">
                                </span>
                            </div>
                            <div class="body">
                                @foreach($category->foods as $food)
                                <div class="menu-item">
                                    <h5>
                                        <a href="shop-single.html">{{ $food->title }}</a>
                                        <span class="dots"></span>
                                        <span class="price px-1">
                                            <span class="currency-symbol">
                                                <img src="/home/images/toman.png" height="25">
                                            </span>
                                            <span class="number">{{ number_format($food->price) }}</span>
                                        </span>
                                    </h5>
                                    <ul>
                                        @foreach($food->ingredients as $ingredient)
                                            <li>
                                                <a>{{ $ingredient->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FEATURE SLIDER -->
    <section class="food-slider">
        <!-- OWL-CAROUSEL -->
        <div class="owl-carousel owl-theme style" id="food-carousel">
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-1.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Salat banana flower</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>40
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-2.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Bread Bacon Mixed Fruit</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>30
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-3.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Beef steak with green</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>70
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-4.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Blueberry Muffin</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>20
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-5.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Fruit Width Egg</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>30
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-6.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Hot Cappuccino</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>20
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-1.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Salat banana flower</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>40
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-2.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Bread Bacon Mixed Fruit</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>30
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="image-holder">
                    <img src='/home/images/image-slide-3.jpg' alt="">
                    <div class="inner">
                        <div class="item-info">
                            <h4>
                                <a href="shop-single.html">Beef steak with green</a>
                            </h4>
                            <div class="star-rating">
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                                <i class="zmdi zmdi-star"></i>
                            </div>
                            <span class="price">
                                    <span>$</span>70
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
