<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="{{  asset('adpay-favicon.png')}}"/>

<!-- TITLE -->
<title>@yield('title')</title>


<!-- BOOTSTRAP CSS -->
<link href="{{asset('assets/admin')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS *** remove rtl to switch *** -->
<link href="{{asset('assets/admin/assets/css-rtl/style.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin')}}/assets/css-rtl/skin-modes.css" rel="stylesheet"/>
<link href="{{asset('assets/admin')}}/assets/css-rtl/dark-style.css" rel="stylesheet"/>

<!-- SIDE-MENU CSS *** remove rtl to switch *** -->
<link href="{{asset('assets/admin')}}/assets/css-rtl/sidemenu.css" rel="stylesheet">

<!--PERFECT SCROLL CSS-->
<link href="{{asset('assets/admin')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet"/>

<!-- CUSTOM SCROLL BAR CSS-->
<link href="{{asset('assets/admin')}}/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

<!--- FONT-ICONS CSS -->
<link href="{{asset('assets/admin/assets/css/icons.css')}}" rel="stylesheet"/>
<!-- simple-tags CSS -->



<!-- SIDEBAR CSS -->
<link href="{{asset('assets/admin')}}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/admin')}}/assets/colors/color1.css" />

{{--<!-- CK EDITOR -->--}}
{{--<script src="{{asset('ckeditor/ckeditor.js')}}"></script>--}}
{{--<!-- TOASTR CSS -->--}}

{{--  ckeditor  --}}
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

{{--  ckeditor  --}}


<!-- Switcher CSS -->
<link href="{{asset('assets/admin')}}/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
<link href="{{asset('assets/admin')}}/assets/switcher/demo.css" rel="stylesheet">

<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/brands.js"></script>
<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/solid.js"></script>
<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/fontawesome.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" />



<link href="{{ asset('assets/admin/assets/css/select2.min.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<style>
    .tgl {
        display: none;
    }
    .tgl, .tgl:after, .tgl:before, .tgl *, .tgl *:after, .tgl *:before, .tgl + .tgl-btn {
        box-sizing: border-box;
    }
    .tgl::-moz-selection, .tgl:after::-moz-selection, .tgl:before::-moz-selection, .tgl *::-moz-selection, .tgl *:after::-moz-selection, .tgl *:before::-moz-selection, .tgl + .tgl-btn::-moz-selection {
        background: none;
    }
    .tgl::selection, .tgl:after::selection, .tgl:before::selection, .tgl *::selection, .tgl *:after::selection, .tgl *:before::selection, .tgl + .tgl-btn::selection {
        background: none;
    }
    .tgl + .tgl-btn {
        outline: 0;
        display: block;
        width: 4em;
        height: 2em;
        position: relative;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .tgl + .tgl-btn:after, .tgl + .tgl-btn:before {
        position: relative;
        display: block;
        content: "";
        width: 50%;
        height: 100%;
    }
    .tgl + .tgl-btn:after {
        left: 0;
    }
    .tgl + .tgl-btn:before {
        display: none;
    }
    .tgl:checked + .tgl-btn:after {
        left: 50%;
    }

    .tgl-light + .tgl-btn {
        background: #f0f0f0;
        border-radius: 2em;
        padding: 2px;
        transition: all 0.4s ease;
    }
    .tgl-light + .tgl-btn:after {
        border-radius: 50%;
        background: #fff;
        transition: all 0.2s ease;
    }
    .tgl-light:checked + .tgl-btn {
        background: #9FD6AE;
    }

    .tgl-ios + .tgl-btn {
        background: #fbfbfb;
        border-radius: 2em;
        padding: 2px;
        transition: all 0.4s ease;
        border: 1px solid #e8eae9;
    }
    .tgl-ios + .tgl-btn:after {
        border-radius: 2em;
        background: #fbfbfb;
        transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
    }
    .tgl-ios + .tgl-btn:hover:after {
        will-change: padding;
    }
    .tgl-ios + .tgl-btn:active {
        box-shadow: inset 0 0 0 2em #e8eae9;
    }
    .tgl-ios + .tgl-btn:active:after {
        padding-right: 0.8em;
    }
    .tgl-ios:checked + .tgl-btn {
        background: #86d993;
    }
    .tgl-ios:checked + .tgl-btn:active {
        box-shadow: none;
    }
    .tgl-ios:checked + .tgl-btn:active:after {
        margin-left: -0.8em;
    }

    .tgl-skewed + .tgl-btn {
        overflow: hidden;
        transform: skew(-10deg);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        transition: all 0.2s ease;
        font-family: sans-serif;
        background: #888;
    }
    .tgl-skewed + .tgl-btn:after, .tgl-skewed + .tgl-btn:before {
        transform: skew(10deg);
        display: inline-block;
        transition: all 0.2s ease;
        width: 100%;
        text-align: center;
        position: absolute;
        line-height: 2em;
        font-weight: bold;
        color: #fff;
        text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
    }
    .tgl-skewed + .tgl-btn:after {
        left: 100%;
        content: attr(data-tg-on);
    }
    .tgl-skewed + .tgl-btn:before {
        left: 0;
        content: attr(data-tg-off);
    }
    .tgl-skewed + .tgl-btn:active {
        background: #888;
    }
    .tgl-skewed + .tgl-btn:active:before {
        left: -10%;
    }
    .tgl-skewed:checked + .tgl-btn {
        background: #86d993;
    }
    .tgl-skewed:checked + .tgl-btn:before {
        left: -100%;
    }
    .tgl-skewed:checked + .tgl-btn:after {
        left: 0;
    }
    .tgl-skewed:checked + .tgl-btn:active:after {
        left: 10%;
    }
    .tgl-flat + .tgl-btn {
        padding: 2px;
        transition: all 0.2s ease;
        background: #fff;
        border: 4px solid #f2f2f2;
        border-radius: 2em;
    }
    .tgl-flat + .tgl-btn:after {
        transition: all 0.2s ease;
        background: #f2f2f2;
        content: "";
        border-radius: 1em;
    }
    .tgl-flat:checked + .tgl-btn {
        border: 4px solid #7FC6A6;
    }
    .tgl-flat:checked + .tgl-btn:after {
        left: 50%;
        background: #7FC6A6;
    }

    .tgl-flip + .tgl-btn {
        padding: 2px;
        transition: all 0.2s ease;
        font-family: sans-serif;
        perspective: 100px;
    }
    .tgl-flip + .tgl-btn:after, .tgl-flip + .tgl-btn:before {
        display: inline-block;
        transition: all 0.4s ease;
        width: 100%;
        text-align: center;
        position: absolute;
        line-height: 2em;
        font-weight: bold;
        color: #fff;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border-radius: 4px;
    }
    .tgl-flip + .tgl-btn:after {
        content: attr(data-tg-on);
        background: #02C66F;
        transform: rotateY(-180deg);
    }
    .tgl-flip + .tgl-btn:before {
        background: #FF3A19;
        content: attr(data-tg-off);
    }
    .tgl-flip + .tgl-btn:active:before {
        transform: rotateY(-20deg);
    }
    .tgl-flip:checked + .tgl-btn:before {
        transform: rotateY(180deg);
    }
    .tgl-flip:checked + .tgl-btn:after {
        transform: rotateY(0);
        left: 0;
        background: #7FC6A6;
    }
    .tgl-flip:checked + .tgl-btn:active:after {
        transform: rotateY(20deg);
    }
</style>
@yield('css')
