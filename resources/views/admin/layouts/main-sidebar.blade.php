<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('adminHome')}}">
            <img src="{{ asset('logoAdpay.png')}}"
                 class="header-brand-img light-logo1" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>العناصر</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('adminHome')}}">
                <i class="fa fa-home side-menu__icon"></i>
                <span class="side-menu__label">الرئيسية</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.index') }}">
                <i class="fa fa-user-secret side-menu__icon"></i>
                <span class="side-menu__label">الادمن</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('appUsers.index') }}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">المستخدمين</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('ads.index') }}">
                <i class="fa fa-tv side-menu__icon"></i>
                <span class="side-menu__label">الاعلانات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('ad_packages.index') }}">
                <i class="fa fa-tv side-menu__icon"></i>
                <span class="side-menu__label">باقات الاعلانات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctionCategories.index') }}">
                <i class="fa fa-cart-plus side-menu__icon"></i>
                <span class="side-menu__label">فئات الحراج</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctionSubCategories.index') }}">
                <i class="fa fa-cart-plus side-menu__icon"></i>
                <span class="side-menu__label">فئات الحراج الفرعية</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctions.index') }}">
                <i class="fa fa-store side-menu__icon"></i>
                <span class="side-menu__label">الحراج</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('notifications.index') }}">
                <i class="fa fa-bell side-menu__icon"></i>
                <span class="side-menu__label">الاشعارات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('orders.index') }}">
                <i class="fa fa-truck side-menu__icon"></i>
                <span class="side-menu__label">الطلبات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('shop_categories.index') }}">
                <i class="fa fa-list side-menu__icon"></i>
                <span class="side-menu__label">فئات المتاجر</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('products.index') }}">
                <i class="fa fa-boxes side-menu__icon"></i>
                <span class="side-menu__label">المنتجات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('sliders.index') }}">
                <i class="fa fa-image side-menu__icon"></i>
                <span class="side-menu__label">الصور المتحركة</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('setting.index') }}">
                <i class="fa fa-wrench side-menu__icon"></i>
                <span class="side-menu__label">اعدادات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('admin.logout')}}">
                <i class="fa fa-door-open side-menu__icon"></i>
                <span class="side-menu__label">تسجيل الخروج</span>
            </a>
        </li>


    </ul>
</aside>

