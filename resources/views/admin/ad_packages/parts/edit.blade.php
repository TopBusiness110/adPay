@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | باقات الاعلانات
@endsection
@section('page_name')
باقات الاعلانات
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> تعديل باقة {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ad_packages.update', $ad_package['id']) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title_ar" class="form-control-label">العنوان بالعربي</label>
                                    <input type="text" class="form-control" value="{{ $ad_package['title_ar'] }}" name="title_ar">
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="form-control-label">العنوان بالانجليزي</label>
                                    <input type="text" class="form-control" value="{{ $ad_package['title_en'] }}" name="title_en">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="count" class="form-control-label">العدد</label>
                                    <input type="number" class="form-control" value="{{ $ad_package['count'] }}" name="count">
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-control-label">السعر</label>
                                    <input type="number" class="form-control" value="{{ $ad_package['price'] }}" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('ad_packages.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
                            <button type="submit" class="btn btn-primary" id="addButton">تعديل</button>
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
