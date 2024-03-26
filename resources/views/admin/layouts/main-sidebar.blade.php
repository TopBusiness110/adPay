<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>العناصر</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="">
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
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">الاعلانات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('ad_packages.index') }}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">باقات الاعلانات</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctionCategories.index') }}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">فئات الحراج</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctionSubCategories.index') }}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">فئات الحراج الفرعية</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('auctions.index') }}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">الحراج</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('admin.logout')}}">
                <i class="fa fa-lock side-menu__icon"></i>
                <span class="side-menu__label">تسجيل الخروج</span>
            </a>
        </li>


    </ul>
</aside>

