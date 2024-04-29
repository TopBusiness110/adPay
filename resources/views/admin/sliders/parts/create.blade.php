@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | الصور المتحركة
@endsection
@section('page_name')
    المدن
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> اضافة صورة {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="form-control-label">الصورة</label>
                                        <input type="file" class="dropify" name="image"
                                            data-default-file="{{ asset('assets/uploads/avatar.png') }}"
                                            accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />
                                        <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif,
                                            jpeg,
                                            jpg,webp</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="status" class="form-control-label">الحاله</label>
                                    <select name="status" class="form-control">
                                        <option value="">اختر</option>
                                        <option value="0">غير مفعل</option>
                                        <option value="1">مفعل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('sliders.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
                            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $('.dropify').dropify()
</script>
