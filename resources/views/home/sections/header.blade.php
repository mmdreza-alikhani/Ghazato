<header>
    <!-- HEADER ON DESKTOP -->
    <nav class="navbar-desktop">
        <div class="left">
            <a href="index.blade.php" class="logo">
                <img src="/home/images/logo.png" alt="Royate">
            </a>
        </div>
        <ul>
            <li class="{{ $active == 'home' ? 'current' : '' }}">
                <a href="menu.html">
                    خانه
                </a>
            </li>
            <li class="{{ $active == 'shops' ? 'current' : '' }}">
                <a href="menu.html">
                    رستوران ها
                </a>
            </li>
            <li class="{{ $active == 'menu' ? 'current' : '' }}">
                <a href="menu.html">
                    منو
                </a>
            </li>
            <li class="{{ $active == 'reservation' ? 'current' : '' }}">
                <a href="menu.html">
                    رزرو میز
                </a>
            </li>
            <li class="has-children">
                <a href="#">
                    Shop
                </a>
                <div class="sub-menu">
                    <div class="wrapper">
                        <ul>
                            <li>
                                <a href="shop-list.html">Shop List</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>

        <div class="right">
            <div class="action">
                <div class="notify">
                    <img style="color: #FFF" height="20" src="/home/images/cart.jpg" alt="">
                    <span class="notify-amount">0</span>

                    <!-- WIDGET SHOPPING -->
                    <div id="woocommerce_widget_cart-2" class="widget woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                            <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                <li class="woocommerce-mini-cart-item mini_cart_item clearfix">
                                    <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item">
                                        <span class="lnr lnr-cross-circle"></span>
                                    </a>
                                    <a href="#" class="image-holder">
                                        <img src="/home/images/widget-cart-thumb-1.jpg" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                        <span class="product-name">Best Brownies</span>
                                    </a>
                                    <span class="quantity">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>18
                                        </span>
                                        x1
                                    </span>
                                </li>
                                <li class="woocommerce-mini-cart-item mini_cart_item clearfix">
                                    <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item">
                                        <span class="lnr lnr-cross-circle"></span>
                                    </a>
                                    <a href="#" class="image-holder">
                                        <img src="/home/images/widget-cart-thumb-2.jpg" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                        <span class="product-name">Angela's Awesome</span>
                                    </a>
                                    <span class="quantity">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>28
                                        </span>
                                        x3
                                    </span>
                                </li>
                            </ul>
                            <p class="woocommerce-mini-cart__total total">
                                <strong>Subtotal:</strong>
                                <span class="woocommerce-Price-amount amount">
											<span class="woocommerce-Price-currencySymbol">$</span>102
										</span>
                            </p>
                            <p class="woocommerce-mini-cart__total total">
                                <strong>Total:</strong>
                                <span class="woocommerce-Price-amount amount color-cdaa7c">
                                    <span class="woocommerce-Price-currencySymbol">$</span>102
                                </span>
                            </p>
                            <p class="woocommerce-mini-cart__buttons buttons">
                                <a href="#" class="button wc-forward view-cart">View cart</a>
                                <a href="#" class="button checkout wc-forward">Checkout</a>
                            </p>
                        </div>
                    </div>
                </div>
                <span class="lnr lnr-magnifier search-icon" data-toggle="modal" data-target="#modalSearch"></span>
                <button class="au-btn round au-btn--hover has-bg">ورود | <i class="fa fa-sign-in-alt"></i> </button>
            </div>
        </div>
    </nav>

    <!-- HEADER ON MOBILE -->
    <nav class="navbar-mobile">
        <div class="container">
            <div class="heading">
                <div class="left">
                    <a href="#" class="navbar-mobile__toggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <a href="index.blade.php" class="logo">
                    <img src="/home/images/logo.png" alt="Royate">
                </a>
                <div class="right">
                    <div class="action">
                        <div class="notify">
                            <img src="/home/images/notify.png" alt="">
                            <span class="notify-amount">0</span>

                            <!-- WIDGET SHOPPING -->
                            <div id="woocommerce_widget_cart-2" class="widget woocommerce widget_shopping_cart">
                                <div class="widget_shopping_cart_content">
                                    <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                        <li class="woocommerce-mini-cart-item mini_cart_item clearfix">
                                            <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item">
                                                <span class="lnr lnr-cross-circle"></span>
                                            </a>
                                            <a href="#" class="image-holder">
                                                <img src="/home/images/widget-cart-thumb-1.jpg" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                                <span class="product-name">Best Brownies</span>
                                            </a>
                                            <span class="quantity">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">$</span>18
                                                </span>
                                                x1
                                            </span>
                                        </li>
                                        <li class="woocommerce-mini-cart-item mini_cart_item clearfix">
                                            <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item">
                                                <span class="lnr lnr-cross-circle"></span>
                                            </a>
                                            <a href="#" class="image-holder">
                                                <img src="/home/images/widget-cart-thumb-2.jpg" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                                <span class="product-name">Angela's Awesome</span>
                                            </a>
                                            <span class="quantity">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">$</span>28
                                                </span>
                                                x3
                                            </span>
                                        </li>
                                    </ul>
                                    <p class="woocommerce-mini-cart__total total">
                                        <strong>Subtotal:</strong>
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">$</span>102
                                        </span>
                                    </p>
                                    <p class="woocommerce-mini-cart__total total">
                                        <strong>Total:</strong>
                                        <span class="woocommerce-Price-amount amount color-cdaa7c">
                                            <span class="woocommerce-Price-currencySymbol">$</span>102
                                        </span>
                                    </p>
                                    <p class="woocommerce-mini-cart__buttons buttons">
                                        <a href="#" class="button wc-forward view-cart">View cart</a>
                                        <a href="#" class="button checkout wc-forward">Checkout</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <span class="lnr lnr-magnifier search-icon" data-toggle="modal" data-target="#modalSearch"></span>
                    </div>
                </div>
            </div>
        </div>
        <nav id="main-nav">
            <ul>
                <li class="current">
                    <a href="#" target="_blank">Home</a>
                    <ul>
                        <li>
                            <a href="index.blade.php">HomePage_v1</a>
                        </li>
                        <li>
                            <a href="index-2.html">HomePage_v2</a>
                        </li>
                        <li class="current">
                            <a href="index-3.html">HomePage_v3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        Page
                    </a>
                    <ul>
                        <li>
                            <a href="about-us.html">About Us</a>
                        </li>
                        <li>
                            <a href="contact-us.html">Contact Us</a>
                        </li>
                        <li>
                            <a href="coming-soon.html">Coming Soon</a>
                        </li>
                        <li>
                            <a href="#">Gallery</a>
                            <ul>
                                <li>
                                    <a href="gallery-three-columns.html">Three Colums</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="project.html">Project</a>
                        </li>
                        <li>
                            <a href="meet-the-chefs.html">Meet The Cheefs</a>
                        </li>
                        <li>
                            <a href="404.html">404</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="menu.html">
                        Menu
                    </a>
                </li>
                <li>
                    <a href="#">
                        Reservation
                    </a>
                    <ul>
                        <li>
                            <a href="reservation_v1.html">Reservation_v1</a>
                        </li>
                        <li>
                            <a href="reservation_v2.html">Reservation_v2</a>
                        </li>
                    </ul>
                </li>
                <li class="has-children">
                    <a href="#">
                        Blog
                    </a>
                    <ul>
                        <li>
                            <a href="blog-masonry.html">Blog Masonry</a>
                        </li>
                        <li>
                            <a href="blog-masonry-wide.html">Blog Masonry Wide</a>
                        </li>
                        <li>
                            <a href="blog-standard-right-sidebar.html">Blog Standard Right Sidebar</a>
                        </li>
                        <li>
                            <a href="blog-standard-left-sidebar.html">Blog Standard Left Sidebar</a>
                        </li>
                        <li>
                            <a href="blog-standard-no-sidebar.html">Blog Standard No Sidebar</a>
                        </li>
                        <li>
                            <a href="blog-single.html">Blog Single</a>
                        </li>
                    </ul>
                </li>
                <li class="has-children">
                    <a href="#">
                        Shop
                    </a>
                    <ul>
                        <li>
                            <a href="shop-list.html">Shop List</a>
                        </li>
                        <li>
                            <a href="shop-three-column.html">Three Columns Grid</a>
                        </li>
                        <li>
                            <a href="shop-three-column-wide.html">Three Columns Wide</a>
                        </li>
                        <li>
                            <a href="shop-four-column.html">Four Colums Grid</a>
                        </li>
                        <li>
                            <a href="shop-four-column-wide.html">Four Colums Wide</a>
                        </li>
                        <li>
                            <a href="shop-cart.html">Shop Cart</a>
                        </li>
                        <li>
                            <a href="shop-single.html">Shop Single</a>
                        </li>
                        <li>
                            <a href="../../../modules/Authentication/Resources/Views/login.blade.php">Sign In</a>
                        </li>
                        <li>
                            <a href="../../../modules/Authentication/Resources/Views/register.blade.php">Sign Up</a>
                        </li>
                        <li>
                            <a href="checkout.html">CheckOut</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </nav>

    <!-- MODAL SEARCH -->
    <div class="modal-search modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="get">
                    <input type="text" placeholder="Search">
                    <button>
                        <span class="lnr lnr-magnifier"></span>
                    </button>
                </form>
            </div>
        </div>
        <span class="lnr lnr-cross" data-toggle="modal" data-target="#modalSearch"></span>
    </div>

    <!-- MENU SIDEBAR -->
    <div class="menu-sidebar">
        <div class="close-btn">
            <span class="lnr lnr-cross" id="close-icon"></span>
        </div>
        <a href="index.blade.php">
            <img src="images/logo-menu-sidebar.png" alt="">
        </a>
        <p class="text">Et harum quidem rerum facilis est et expedita distinctio nam libero.</p>
        <!-- SLIDER -->
        <div class="owl-carousel owl-theme image-slider style-1" id="image-carousel">
            <div class="item">
                <a href="#">
                    <img src='/home/images/menu-sidebar-slide-1.jpg' alt="">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src='/home/images/menu-sidebar-slide-2.jpg' alt="">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src='/home/images/menu-sidebar-slide-3.jpg' alt="">
                </a>
            </div>
        </div>
        <!-- CONTACT -->
        <div class="contact-part">
            <div class="contact-line">
                <span class="lnr lnr-home"></span>
                <span>No 40 Baria Sreet 133/2</span>
            </div>
            <div class="contact-line">
                <a href="tel:+15618003666666">
                    <span class="lnr lnr-phone-handset"></span>
                    <span> + (156) 1800-366-6666</span>
                </a>
            </div>
            <div class="contact-line">
                <a href="#">
                    <span class="lnr lnr-envelope"></span>
                    <span>Eric-82@example.com</span>
                </a>
            </div>
        </div>
        <!-- SOCIAL -->
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
</header>
