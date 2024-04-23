@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | الاعدادات
@endsection
@section('page_name')
    الاعدادات
@endsection
@section('content')

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }

        /* Import Google Font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> اعدادات {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('setting.update') }}" >
                        @csrf
                        <input type="hidden" value="{{ $settingData['id'] }}" name="id">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="name" class="form-control-label">اللوجو</label>
                                        <input type="file" class="dropify" name="logo"
                                               data-default-file="{{asset('storage/'.$settingData['logo'])}}" value=""
                                           accept="image/png,image/webp , image/gif, image/jpeg,image/jpg"/>
                                    <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif,jpeg, jpg,webp</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name_ar" class="form-control-label">الهاتف</label>
                                    <input type="text" class="form-control"  pattern="[0-9]{10}"  id="indicesInput" value="{{ $settingData['phones'] }}" name="phones" required>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <label for="name_ar" class="form-control-label">نقاط البيع</label>
                                    <input type="text" class="form-control"  value="{{ $settingData['point_video'] }}" name="point_video" required>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name_ar" class="form-control-label">وصف القيمه في المزاد</label>
                                    <textarea type="text" class="form-control" name="about_us" required>{{ $settingData['about_us'] }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="name_ar" class="form-control-label">الخصوصيه</label>
                                    <textarea type="text" class="form-control" name="privacy" required>{{ $settingData['privacy'] }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="whatsapp" class="form-control-label">الواتساب</label>
                                    <input type="url" class="form-control"    value="{{ $settingData['whatsapp'] }}" name="whatsapp" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="fcm_server" class="form-control-label">الخادم </label>
                                    <textarea type="text" class="form-control"  name="fcm_server" required>{{ $settingData['fcm_server']}}</textarea>

                                </div>




                            </div>
                            </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    @include('admin/layouts/myAjaxHelper')--}}
@endsection
@section('ajaxCalls')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"--}}
    {{--        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="--}}
    {{--        crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    {{----}}
    <script>
        $('.dropify').dropify()
        {{--        editScript();--}}
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputElm = document.querySelector('[name="phones"]'),
                tagify = new Tagify(inputElm);

            inputElm.addEventListener('change', onChange);

            function onChange(e){
                // outputs a String
                console.log(e.target.value)
            }
        });
    </script>





@endsection
