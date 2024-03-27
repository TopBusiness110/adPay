@extends('admin/layouts/master')

@section('title')
    {{ $setting->name_en ?? '' }} | فئات الحراج الفرعية
@endsection
@section('page_name')
    فئات الحراج الفرعية
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> اضافة فئة فرعية {{ $setting->name_en ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('auctionSubCategory.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="cat_id" class="form-control-label">الفئة</label>
                                    <select name="cat_id" class="form-control">
                                        <option value="">اختر الفئة</option>
                                        @foreach ($auctionCategories as $auctionCategory)
                                            <option value="{{ $auctionCategory->id }}">{{ $auctionCategory->title_ar ?? '' }}</option>
                                        @endforeach>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title_ar" class="form-control-label">العنوان بالعربي</label>
                                    <input type="text" class="form-control" name="title_ar">
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="form-control-label">العنوان بالانجليزي</label>
                                    <input type="text" class="form-control" name="title_en">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('auctionSubCategories.index') }}" class="btn btn-info text-white">رجوع للخلف</a>
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
