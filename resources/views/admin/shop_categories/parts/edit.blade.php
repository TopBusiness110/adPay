@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | فئة المتاجر
@endsection
@section('page_name')
    فئة المتاجر
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> تعديل فئة {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('shop_category.update', $shopCategory['id']) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title_ar" class="form-control-label">العنوان بالعربي</label>
                                    <input type="text" class="form-control" value="{{ $shopCategory['title_ar'] }}"
                                        name="title_ar">
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="form-control-label">العنوان بالانجليزي</label>
                                    <input type="text" class="form-control" value="{{ $shopCategory['title_en'] }}"
                                        name="title_en">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="title_ar" class="form-control-label">الحالة</label>
                                    <select class="form-control" name="status">
                                        <option value="0" {{ $shopCategory['status'] == 0 ? 'selected' : '' }}>غير مفعل
                                        </option>
                                        <option value="1" {{ $shopCategory['status'] == 1 ? 'selected' : '' }}>مفعل
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('shop_categories.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
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
