<div id="dw-s1" class="bmd-layout-drawer bg-faded">
    <div class="container-fluid side-bar-container">
        <header class="pb-0">
            <a class="navbar-brand">
                <object class="side-logo" data="/admin/svg/logo-8.svg" type="image/svg+xml"></object>
            </a>
        </header>
        <li class="side a-collapse short m-2 pr-1 pl-1">
            <a href="{{ route('admin.index') }}" class="side-item {{ $active_parent == 'dashboard' ? 'selected' : '' }}">
                <i class="fas fa-tachometer-alt mr-1"></i>داشبورد
            </a>
        </li>
        <p class="side-comment fnt-mxs">کاربران</p>
        <ul class="side a-collapse {{ $active_parent == 'users' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-user-friends mr-1"></i> کاربران
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'users' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'showUsers' ? 'selected' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش کاربران
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'roles' ? 'selected' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>گروه های  کاربری
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'permissions' ? 'selected' : '' }}">
                    <a href="./" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>دسترسی ها
                    </a>
                </li>
            </div>
        </ul>
        <p class="side-comment fnt-mxs">محصولات</p>
        <ul class="side a-collapse {{ $active_parent == 'categories' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-tasks mr-1"></i> دسته بندی ها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'categories' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageCategories' ? 'selected' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش دسته بندی ها
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedCategories' ? 'selected' : '' }}">
                    <a href="{{ route('admin.categories.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'ingredients' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-carrot mr-1"></i>ترکیبات
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'ingredients' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageIngredients' ? 'selected' : '' }}">
                    <a href="{{ route('admin.ingredients.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش ترکیبات
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'foods' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-hamburger mr-1"></i>غذا ها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'foods' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageFoods' ? 'selected' : '' }}">
                    <a href="{{ route('admin.foods.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش غذا ها
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedFoods' ? 'selected' : '' }}">
                    <a href="{{ route('admin.foods.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'shops' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-shopping-cart mr-1"></i>رستوران ها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'shops' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageShops' ? 'selected' : '' }}">
                    <a href="{{ route('admin.shops.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش رستوران ها
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedShops' ? 'selected' : '' }}">
                    <a href="{{ route('admin.shops.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
        <p class="side-comment fnt-mxs">سفارشات</p>
        <ul class="side a-collapse {{ $active_parent == 'orders' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-dot-circle mr-1"></i>سفارشات
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'orders' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageOrders' ? 'selected' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش سفارشات
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'coupons' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-gift mr-1"></i>کد های تخفیف
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'coupons' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageCoupons' ? 'selected' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش کد های تخفیف
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedCoupons' ? 'selected' : '' }}">
                    <a href="{{ route('admin.coupons.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>

        <p class="side-comment fnt-mxs">رزرو</p>
        <ul class="side a-collapse {{ $active_parent == 'ceremonies' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-award mr-1"></i>مراسمات
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'ceremonies' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageCeremonies' ? 'selected' : '' }}">
                    <a href="{{ route('admin.ceremonies.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش مراسمات
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedCeremonies' ? 'selected' : '' }}">
                    <a href="{{ route('admin.ceremonies.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'tables' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-table mr-1"></i>میز ها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'tables' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageTables' ? 'selected' : '' }}">
                    <a href="{{ route('admin.tables.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش میز ها
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedTables' ? 'selected' : '' }}">
                    <a href="{{ route('admin.tables.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'reservations' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-calendar mr-1"></i>رزرو ها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'reservations' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageReservations' ? 'selected' : '' }}">
                    <a href="{{ route('admin.reservations.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش رزرو ها
                    </a>
                </li>
            </div>
        </ul>

        <p class="side-comment fnt-mxs">عمومی</p>
        @php
            $undecidedComments = \App\Models\Comment::where('status', '=', 0)->get();
        @endphp
        <ul class="side a-collapse {{ $active_parent == 'comments' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-comment mr-1"></i>نظرات
                <i class="fas fa-chevron-down arrow"></i>
                <span class="badge badge-pill badge-warning animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s">{{ $undecidedComments->count() }}</span>
            </a>
            <div class="side-item-container {{ $active_parent == 'comments' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageComments' ? 'selected' : '' }}">
                    <a href="{{ route('admin.comments.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش نظرات
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'feedback' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-envelope mr-1"></i>انتقادات
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'feedback' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageFeedback' ? 'selected' : '' }}">
                    <a href="{{ route('admin.feedback.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش انتقادات
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'settings' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-cogs mr-1"></i>تنظیمات
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'settings' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageSettings' ? 'selected' : '' }}">
                    <a href="{{ route('admin.settings.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش تنظیمات
                    </a>
                </li>
            </div>
        </ul>
        <ul class="side a-collapse {{ $active_parent == 'banners' ? '' : 'short' }}">
            <a class="ul-text fnt-mxs"><i class="fas fa-bars mr-1"></i>بنرها
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="side-item-container {{ $active_parent == 'banners' ? '' : 'hide animated' }}">
                <li class="side-item {{ $active_child == 'manageBanners' ? 'selected' : '' }}">
                    <a href="{{ route('admin.banners.index') }}" class="fnt-mxs">
                        <i class="fas fa-angle-right mr-2"></i>نمایش بنر ها
                    </a>
                </li>
                <li class="side-item {{ $active_child == 'manageDeletedBanners' ? 'selected' : '' }}">
                    <a href="{{ route('admin.banners.trash') }}" class="fnt-mxs">
                        <i class="fas fa-trash mr-2"></i>سطل اشغال
                    </a>
                </li>
            </div>
        </ul>
    </div>
</div>
